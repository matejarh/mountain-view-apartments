<?php

namespace Tests\Feature;

use App\Models\Property;
use App\Models\Reservation;
use App\Notifications\Admin\ReservationReceived;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Mockery;
use Stripe\Stripe;
use Tests\TestCase;

class ReservationsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    public function test_authenticated_user_may_post_reservation_for_given_property(): void
    {
        Notification::fake();
        $property = Property::factory()->create();

        $reservation = [
            'arrival' => now()->addWeek(),
            'departure' => now()->addWeek()->addDays(3),
            'guests' => [
                'adults' => 2,
                'children' => 1,
                'pets' => false,
            ],
            'message' => 'A message with reservation'
        ];
        $response = $this->actingAs($this->user)->post(route('properties.reservations.store', $property), $reservation);

        $response->assertStatus(302)->assertSessionHas('status','reservation-created');

        Notification::assertSentTo([$this->admin], ReservationReceived::class);
    }

    public function test_reservation_dates_for_given_property_may_not_overlap(): void
    {
        Notification::fake();
        $property = Property::factory()->create();

        $reservation1 = [
            'arrival' => now()->addWeek()->format('Y-m-d'),
            'departure' => now()->addWeek()->addDays(3)->format('Y-m-d'),
            'guests' => [
                'adults' => 2,
                'children' => 1,
                'pets' => false,
            ],
            'message' => 'A message with reservation'
        ];
        $response = $this->actingAs($this->user)->post(route('properties.reservations.store', $property), $reservation1);

        $response->assertStatus(302)->assertSessionHas('status','reservation-created');

        Notification::assertSentTo([$this->admin], ReservationReceived::class);

        $reservation1 = Reservation::first();
        $reservation1->confirm();
        $reservation1->approvePayment();

        $reservation2 = [
            'arrival' => now()->addWeek()->addDays(2)->format('Y-m-d'),
            'departure' => now()->addWeek()->addDays(5)->format('Y-m-d'),
            'guests' => [
                'adults' => 2,
                'children' => 1,
                'pets' => false,
            ],
            'message' => 'An overlaping reservation'
        ];

        $response = $this->actingAs($this->user)->post(route('properties.reservations.store', $property), $reservation2);

        $response->assertStatus(302)->assertSessionHasErrors('date_range','The selected date range is not available.');

        $reservation3 = [
            'arrival' => now()->addWeek()->addDays(3)->format('Y-m-d'),
            'departure' => now()->addWeek()->addDays(5)->format('Y-m-d'),
            'guests' => [
                'adults' => 2,
                'children' => 1,
                'pets' => false,
            ],
            'message' => 'An overlaping reservation'
        ];

        $response = $this->actingAs($this->user)->post(route('properties.reservations.store', $property), $reservation3);

        $response->assertStatus(302)->assertSessionDoesntHaveErrors()->assertSessionHas('status','reservation-created');

        Notification::assertSentTo([$this->admin], ReservationReceived::class);

        $this->assertCount(2, $property->fresh()->reservations);
    }


    public function test_admin_may_update_given_reservation() :void
    {
        $reservation = Reservation::factory()->create();

        $updatedReservation = [
            'message' => 'Updated Message',
        ];

        $response = $this->actingAs($this->admin)->put(route('admin.reservations.update', $reservation), $updatedReservation);

        $response->assertStatus(302)->assertSessionDoesntHaveErrors()->assertSessionHas('status','reservation-updated');

    }

    public function test_admin_may_delete_given_reservation() :void
    {
        $reservation = Reservation::factory()->create();

        $response = $this->actingAs($this->admin)->delete(route('admin.reservations.destroy', $reservation));

        $response->assertStatus(302)->assertSessionDoesntHaveErrors()->assertSessionHas('status','reservation-deleted');

        $this->assertDatabaseEmpty(Reservation::class);

    }

    public function test_user_or_guest_may_not_update_given_reservation() :void
    {
        $reservation = Reservation::factory()->create();

        $updatedReservation = [
            'message' => 'Updated Message',
        ];

        $response = $this->put(route('admin.reservations.update', $reservation), $updatedReservation);
        $response->assertStatus(302)->assertRedirect(route('login'));

        $response = $this->actingAs($this->user)->put(route('admin.reservations.update', $reservation), $updatedReservation);

        $response->assertStatus(403);
    }

    public function test_admin_may_confirm_given_reservation() :void
    {
        $reservation = Reservation::factory()->create();

        $response = $this->actingAs($this->admin)->put(route('admin.reservations.confirm', $reservation))
            ->assertStatus(302)->assertSessionHasNoErrors()->assertSessionHas('status', 'reservation-confirmed');
        $this->assertNotNull($reservation->fresh()->confirmed_at);
    }

    public function test_admin_may_reject_given_reservation() :void
    {
        $reservation = Reservation::factory()->create();
        $reservation->confirm();
        $this->assertNotNull($reservation->fresh()->confirmed_at);

        $response = $this->actingAs($this->admin)->put(route('admin.reservations.reject', $reservation))
            ->assertStatus(302)->assertSessionHasNoErrors()->assertSessionHas('status', 'reservation-rejected');
        $this->assertNull($reservation->fresh()->confirmed_at);
    }

    public function test_admin_may_approve_payment_for_given_reservation() :void
    {
        $reservation = Reservation::factory()->create();

        $response = $this->actingAs($this->admin)->put(route('admin.reservations.approve.payment', $reservation))
            ->assertStatus(302)->assertSessionHasNoErrors()->assertSessionHas('status', 'reservation-payment-approved');

        $this->assertNotNull($reservation->fresh()->payment_received_at);
    }

    public function test_admin_may_reject_payment_for_given_reservation() :void
    {
        $reservation = Reservation::factory()->create();

        $reservation->approvePayment();

        $this->assertNotNull($reservation->fresh()->payment_received_at);

        $response = $this->actingAs($this->admin)->put(route('admin.reservations.reject.payment', $reservation))
            ->assertStatus(302)->assertSessionHasNoErrors()->assertSessionHas('status', 'reservation-payment-rejected');

        $this->assertNull($reservation->fresh()->payment_received_at);
    }


    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
