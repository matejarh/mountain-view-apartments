<?php

namespace Tests\Feature;

use App\Models\Property;
use App\Models\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReviewsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_user_may_post_review_for_property(): void
    {
        $property = Property::factory()->create();
        $review = [
            'score' => 5,
            'text' => 'Some test review',
        ];
        $response = $this->actingAs($this->user)->post(route('properties.review', $property), $review);

        $response->assertStatus(302)->assertSessionHas(['status' => 'property-reviewed']);

        $response = $this->actingAs($this->user)->post(route('properties.review', $property), $review);
        $response->assertStatus(302)->assertSessionMissing(['status' => 'property-reviewed'])->assertSessionHas(['flash.bannerStyle' => 'danger']);
        $this->actingAs($this->user)->assertEquals($property->fresh()->isReviewed(), true);
        //dd($response->ddSession());
    }

    public function test_guest_may_not_post_review_for_property(): void
    {
        $property = Property::factory()->create();
        $review = [
            'score' => 5,
            'text' => 'Some test review',
        ];

        $response = $this->post(route('properties.review', $property), $review)
            ->assertStatus(302)->assertRedirect(route('login'));
    }

    public function test_reviews_screen_may_not_be_rendered_for_user(): void
    {

        $response = $this->actingAs($this->user)->get(route('admin.reviews.index'))
            ->assertStatus(403);
    }

    public function test_reviews_screen_may_be_rendered_for_admin(): void
    {

        $response = $this->actingAs($this->admin)->get(route('admin.reviews.index'))
            ->assertStatus(200);
    }

    public function test_admin_may_create_new_review(): void
    {
        // $this->withoutExceptionHandling();
        $property = Property::factory()->create();
        $review = [
            'score' => 5,
            'text' => 'Some test review',
        ];

        $response = $this->post(route('admin.reviews.store', $property), $review)
            ->assertStatus(302)->assertRedirect(route('login'));
        $response = $this->actingAs($this->user)->post(route('admin.reviews.store', $property), $review)
            ->assertStatus(403);
        $response = $this->actingAs($this->admin)->post(route('admin.reviews.store', $property), $review)
            ->assertStatus(302);
        //dd($response);
        $review = Review::first();

        $this->assertEquals($review->fresh()->score, $review["score"]);
        $this->assertEquals($review->fresh()->text, $review["text"]);
        $this->assertEquals(1, Review::count());

    }

    public function test_admin_may_approve_review(): void
    {

        $review = Review::factory()->create();

        $this->assertNull($review->approved_at);

        $response = $this->actingAs($this->admin)->put(route('admin.reviews.approve', $review));

        $response->assertStatus(302)->assertSessionHas(['status' => 'review-approved']);

        $this->assertNotNull($review->fresh()->approved_at);
    }

    public function test_admin_may_reject_review(): void
    {
        $review = Review::factory()->create(['approved_at' => now()]);

        $this->assertNotNull($review->approved_at);

        $response = $this->actingAs($this->admin)->put(route('admin.reviews.reject', $review));

        $response->assertStatus(302)->assertSessionHas(['status' => 'review-rejected']);

        $this->assertNull($review->fresh()->approved_at);
    }
}
