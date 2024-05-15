<?php

namespace Tests\Feature;

use App\Models\Property;
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
            'rating' => 5,
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
            'rating' => 5,
            'text' => 'Some test review',
        ];

        $response = $this->post(route('properties.review', $property), $review)
            ->assertStatus(302)->assertRedirect(route('login'));
    }
}
