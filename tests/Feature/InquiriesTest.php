<?php

namespace Tests\Feature;

use App\Models\Inquiry;
use App\Models\Property;

use App\Notifications\Admin\InquiryReceivedNotification;
use App\Notifications\ReplyToInquiry;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class InquiriesTest extends TestCase
{
    use RefreshDatabase;

    public $inquiry;
    public function setUp() :void
    {
        parent::setUp();
        Notification::fake();
        Queue::fake();

        $this->inquiry = [
            'name' => 'Janez',
            'email' => 'janez@jaez.si',
            'phone' => '040481181',
            'adults' => fake()->randomElement([1,2,3,4]),
            'children' => fake()->randomElement([1,2,3,4]),
            'pets' => fake()->randomElement([1,0]),
            'subject' => 'Nekej za subjekt',
            'message' => 'Nekeja za besedilo bla bla bla',
            'date' => [now()->addDay(), now()->addWeek()],
        ];
    }


    /**
     * A basic feature test example.
     */
    public function test_guest_may_post_inquiry(): void
    {
        $property = Property::factory()->create();

        $inquiry = $this->inquiry;
        $response = $this->post(route('inquiry.store', $property), $inquiry);
        //$this->assertCount(1, $this->admin->notifications);
        $response->assertStatus(302);
        $response->assertSessionHas(["status" => "inquiry-created"]);
        $this->assertCount(1, Inquiry::all());
        Notification::assertSentTo(
            [$this->admin], InquiryReceivedNotification::class
        );

    }

    public function test_user_may_post_inquiry(): void
    {

        $property = Property::factory()->create();

        $inquiry = $this->inquiry;
        $response = $this->actingAs($this->user)->post(route('inquiry.store', $property), $inquiry);
        //$this->assertCount(1, $this->admin->notifications);
        $this->assertCount(1, Inquiry::all());
        $response->assertStatus(302);
        //$response->ddSession();
        $response->assertSessionHas(["status" => "inquiry-created"]);
        $response->assertSessionHas(["flash" => ["banner" => "Inquiry has been submited."]]);
        Notification::assertSentTo(
            [$this->admin], InquiryReceivedNotification::class
        );
    }

    public function test_admin_may_post_inquiry(): void
    {

        $property = Property::factory()->create();

        $inquiry = $this->inquiry;
        $response = $this->actingAs($this->admin)->post(route('admin.inquiries.store', $property), $inquiry);
        //$this->assertCount(1, $this->admin->notifications);
        $this->assertCount(1, Inquiry::all());
        $response->assertStatus(302);
        //$response->ddSession();
        $response->assertSessionHas(["status" => "inquiry-created"]);
        $response->assertSessionHas(["flash" => ["banner" => "Inquiry has been submited."]]);
        Notification::assertNothingSentTo(
            [$this->admin]
        );
    }

    public function test_admin_may_update_any_inquiry(): void
    {
        $inquiry = Inquiry::factory()->create();

        $updatedInquiry = $this->inquiry;
        $response = $this->actingAs($this->admin)->put(route('admin.inquiries.update', $inquiry), $updatedInquiry);
        //$this->assertCount(1, $this->admin->notifications);
        $this->assertCount(1, Inquiry::all());
        $response->assertStatus(302);
        //$response->ddSession();
        $response->assertSessionHas(["status" => "inquiry-updated"]);
        $response->assertSessionHas(["flash" => ["banner" => "Inquiry has been updated."]]);
    }

    public function test_admin_may_delete_any_inquiry(): void
    {
        $inquiry = Inquiry::factory()->create();

        $this->assertCount(1, Inquiry::all());
        $response = $this->actingAs($this->admin)->delete(route('admin.inquiries.destroy', $inquiry));
        //$this->assertCount(1, $this->admin->notifications);
        $response->assertStatus(302);
        $this->assertCount(0, Inquiry::all());
        $response->assertSessionHas(["status" => "inquiry-deleted"]);

        $response = $this->actingAs($this->user)->delete(route('admin.inquiries.destroy', $inquiry));
        //$response->ddSession();
        $response->assertStatus(404);
        $response = $this->delete(route('admin.inquiries.destroy', $inquiry));
        $response->assertStatus(404);
        //$response->assertSessionHas(["flash" => ["banner" => "Inquiry has been deleted.", 'bannerStyle', 'danger']]);
    }

    public function test_user_or_guest_may_not_update_any_inquiry(): void
    {
        $inquiry = Inquiry::factory()->create();

        $updatedInquiry = $this->inquiry;
        $response = $this->actingAs($this->user)->put(route('admin.inquiries.update', $inquiry), $updatedInquiry);
        $this->assertCount(0, $this->admin->notifications);
        $this->assertCount(1, Inquiry::all());
        $response->assertStatus(403);
        //$response->ddSession();
        $response->assertSessionMissing(["status" => "inquiry-updated"]);
        $response->assertSessionMissing(["flash" => ["banner" => "Inquiry has been updated."]]);
        $response = $this->put(route('admin.inquiries.update', $inquiry), $updatedInquiry);
        $response->assertStatus(403);
    }

    public function test_guest_may_not_post_out_of_range_date(): void
    {
        $property = Property::factory()->create();
        $inquiry = $this->inquiry;
        $inquiry['date'] = [now(), now()->addWeek()];

        $response = $this->post(route('inquiry.store', $property), $inquiry);
        //$response->ddSession();
        $response->assertStatus(302)->assertSessionHasErrors(['date.0'],null, 'creatingInquiry');

        $inquiry['date'] = [now()->addDay(), now()->addYear()->addDay()];
        $response = $this->post(route('inquiry.store', $property), $inquiry);
        $response->assertStatus(302)->assertSessionHasErrors(['date.1'],null, 'creatingInquiry');

        $inquiry['date'] = [now(), now()->addYear()->addDay()];
        $response = $this->post(route('inquiry.store', $property), $inquiry);
        $response->assertStatus(302)->assertSessionHasErrors(['date.1', 'date.0'],null, 'creatingInquiry');

    }

    public function test_admin_may_reply_to_given_guest_inquiry() :void
    {
        $this->withExceptionHandling();
        $inquiry = Inquiry::factory()->create(['user_id' => null]);

        $reply = [
            'name' => $inquiry->name,
            'email' => $inquiry->email,
            'subject' => 'Reply to inquiry',
            'text' => 'Reply text pa še mal da bo 10'
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.inquiries.reply', $inquiry), $reply)
            ->assertStatus(302)
            ->assertSessionHas(['status' => 'inquiry-replied']);
        $this->assertNotNull($inquiry->fresh()->read_at);
        Notification::assertSentOnDemand(ReplyToInquiry::class);
    }

    public function test_admin_may_reply_to_given_user_inquiry() :void
    {
        $this->withExceptionHandling();
        $inquiry = Inquiry::factory()->create(['user_id' => $this->user->id]);

        $reply = [
            'name' => $inquiry->name,
            'email' => $inquiry->email,
            'subject' => 'Reply to inquiry',
            'text' => 'Reply text pa še mal da bo 10'
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.inquiries.reply', $inquiry), $reply)
            ->assertStatus(302)
            ->assertSessionHas(['status' => 'inquiry-replied']);
        $this->assertNotNull($inquiry->fresh()->read_at);
        Notification::assertSentTo([$this->user],ReplyToInquiry::class);
    }
}
