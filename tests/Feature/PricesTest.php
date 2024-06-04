<?php

namespace Tests\Feature;

use App\Models\Price;
use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PricesTest extends TestCase
{
    use RefreshDatabase;

    public $price;

    public function setUp(): void
    {
        parent::setUp();

        $this->price = [
            // 'from' => \Carbon\Carbon::parseFromLocale('11.07.2024', 'sl'),
            // 'to' => \Carbon\Carbon::parseFromLocale('25.08.2024', 'sl'),
            'range' => [\Carbon\Carbon::parseFromLocale('11.07.2024', 'sl'), \Carbon\Carbon::parseFromLocale('25.08.2024', 'sl')],
            'min_days' => 4,
            'max_days' => 10,
            'prices' => [
                ['guests' => 1, 'price' => '65'],
                ['guests' => 2, 'price' => '75'],
            ],
            //'guests' => 5,
            //'price' => '900,00',
        ];
    }

    public function test_admin_may_create_new_price_for_given_property(): void
    {
        $property = Property::factory()->create();

        $response = $this->actingAs($this->admin)->post(route('admin.prices.store', $property), $this->price)
            ->assertStatus(302)
            ->assertSessionHasNoErrors()
            ->assertSessionHas('status', 'price-created');

        $this->assertDatabaseCount('prices', 1);
    }

    public function test_user_may_not_create_new_price_for_given_property(): void
    {
        $property = Property::factory()->create();

        $response = $this->actingAs($this->user)->post(route('admin.prices.store', $property), $this->price)
            ->assertStatus(403);

        $this->assertDatabaseCount('prices', 0);
    }

    public function test_admin_may_update_given_price(): void
    {
        $price = Price::factory()->create();

        $updatedPrice = [
            // 'from' => '11.07.2024',
            // 'to' => '25.08.2024',
            'range' => [\Carbon\Carbon::parseFromLocale('11.07.2024', 'sl'), \Carbon\Carbon::parseFromLocale('25.08.2024', 'sl')],
            'min_days' => 3,
            'max_days' => 7,
            'prices' => [
                ['guests' => 1, 'price' => '65'],
                ['guests' => 2, 'price' => '75.123'],
            ],
        ];

        $response = $this->actingAs($this->admin)->put(route('admin.prices.update', $price), $updatedPrice)
            ->assertStatus(302)
            ->assertSessionHasNoErrors()
            ->assertSessionHas('status', 'price-updated');

        $this->assertEquals($price->fresh()->prices[0]['guests'], 1);
        $this->assertEquals($price->fresh()->prices[0]['price'], '65');
        $this->assertEquals($price->fresh()->prices[1]['guests'], 2);
        $this->assertEquals($price->fresh()->prices[1]['price'], '75.123');
        $this->assertEquals($price->fresh()->min_days, 3);
        $this->assertEquals($price->fresh()->max_days, 7);
    }

    public function test_price_date_ranges_may_not_overlap(): void
    {
        $property = Property::factory()->create();

        $price1 = Price::factory()->create([
            // 'range' => [ \Carbon\Carbon::parseFromLocale('11.07.2024', 'sl'), \Carbon\Carbon::parseFromLocale('25.08.2024', 'sl')],
            'from' => \Carbon\Carbon::parseFromLocale('11.07.2024', 'sl'),
            'to' => \Carbon\Carbon::parseFromLocale('25.08.2024', 'sl'),
            'prices' => [
                ['guests' => 1, 'price' => '65'],
                ['guests' => 2, 'price' => '75'],
            ],
            'property_id' => $property->id,
        ]);

        $price2 = [
            'range' => [\Carbon\Carbon::parseFromLocale('23.07.2024', 'sl'), \Carbon\Carbon::parseFromLocale('25.09.2024', 'sl')],
            'prices' => [
                ['guests' => 1, 'price' => '65'],
                ['guests' => 2, 'price' => '75'],
            ],
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.prices.store', $property), $price2)
            ->assertStatus(302);
        // $response->ddSession();
        $response->assertSessionHasErrors(['range' => 'The selected date range overlaps with existing.'], null, 'creatingPrice')
            ->assertSessionMissing(['status' => 'price-created']);


        $price3 = [
            'range' => [\Carbon\Carbon::parseFromLocale('26.08.2024', 'sl'), \Carbon\Carbon::parseFromLocale('25.09.2024', 'sl')],
            'prices' => [
                ['guests' => 1, 'price' => '65'],
                ['guests' => 2, 'price' => '75'],
            ],
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.prices.store', $property), $price3)
            ->assertStatus(302)
            ->assertSessionHasNoErrors()
            ->assertSessionHas(['status' => 'price-created']);
    }

    public function test_guest_may_not_create_new_price_for_given_property(): void
    {
        $property = Property::factory()->create();

        $response = $this->post(route('admin.prices.store', $property), $this->price)
            ->assertStatus(302)
            ->assertRedirect(route('login'));

        $this->assertDatabaseCount('prices', 0);
    }

    public function test_admin_may_delete_given_price(): void
    {
        $price = Price::factory()->create();

        $response = $this->actingAs($this->admin)->delete(route('admin.prices.destroy', $price))
            ->assertStatus(302)
            ->assertSessionHasNoErrors()
            ->assertSessionHas('status', 'price-destroyed');

        $this->assertDatabaseEmpty('prices');
    }

    public function test_user_may_not_delete_given_price(): void
    {
        $price = Price::factory()->create();

        $response = $this->actingAs($this->user)->delete(route('admin.prices.destroy', $price))
            ->assertStatus(403)
            ->assertSessionHasNoErrors()
            ->assertSessionMissing(['status' => 'price-destroyed']);

        $this->assertDatabaseCount('prices', 1);
    }

    public function test_guest_may_not_delete_given_price(): void
    {
        $price = Price::factory()->create();

        $response = $this->delete(route('admin.prices.destroy', $price))
            ->assertStatus(302)
            ->assertSessionHasNoErrors()
            ->assertSessionMissing(['status' => 'price-destroyed'])
            ->assertRedirectToRoute('login');

        $this->assertDatabaseCount('prices', 1);
    }
}
