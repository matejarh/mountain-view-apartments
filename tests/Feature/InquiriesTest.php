<?php

namespace Tests\Feature;

use App\Models\Inquiry;
use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class InquiriesTest extends TestCase
{
    use RefreshDatabase;

    public $inquiry;
    public function setUp() :void
    {
        parent::setUp();

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
        Queue::fake();

        $property = Property::factory()->create();

        $inquiry = $this->inquiry;
        $response = $this->post(route('inquiry.create', $property), $inquiry);
        //$this->assertCount(1, $this->admin->notifications);
        $response->assertStatus(302);
        $response->assertSessionHas(["status" => "inquiry-created"]);
        $this->assertCount(1, Inquiry::all());

    }

    public function test_user_may_post_inquiry(): void
    {
        Queue::fake();
        $property = Property::factory()->create();

        $inquiry = $this->inquiry;
        $response = $this->actingAs($this->user)->post(route('inquiry.create', $property), $inquiry);
        //$this->assertCount(1, $this->admin->notifications);
        $this->assertCount(1, Inquiry::all());
        $response->assertStatus(302);
        //$response->ddSession();
        $response->assertSessionHas(["status" => "inquiry-created"]);
        $response->assertSessionHas(["flash" => ["banner" => "Inquiry has been submited."]]);
    }

    public function test_admin_may_post_inquiry(): void
    {
        Queue::fake();
        $property = Property::factory()->create();

        $inquiry = $this->inquiry;
        $response = $this->actingAs($this->admin)->post(route('admin.inquiries.store', $property), $inquiry);
        //$this->assertCount(1, $this->admin->notifications);
        $this->assertCount(1, Inquiry::all());
        $response->assertStatus(302);
        //$response->ddSession();
        $response->assertSessionHas(["status" => "inquiry-created"]);
        $response->assertSessionHas(["flash" => ["banner" => "Inquiry has been submited."]]);
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

        $response = $this->post(route('inquiry.create', $property), $inquiry);
        //dd($response->ddSession());
        $response->assertStatus(302)->assertSessionHasErrors(['date.0']);

        $inquiry['date'] = [now()->addDay(), now()->addYear()->addDay()];
        $response = $this->post(route('inquiry.create', $property), $inquiry);
        $response->assertStatus(302)->assertSessionHasErrors(['date.1']);

        $inquiry['date'] = [now(), now()->addYear()->addDay()];
        $response = $this->post(route('inquiry.create', $property), $inquiry);
        $response->assertStatus(302)->assertSessionHasErrors(['date.1', 'date.0']);

    }
}
