<?php

namespace Tests\Feature;

use App\Models\Property;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LikesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_user_may_like_property(): void
    {
        $property = Property::factory()->create();

        $this->assertCount(0, $property->likes);

        $response = $this->actingAs($this->user)->post(route('properties.like', ['property' => $property, 'lang' => app()->currentLocale()]))
        ->assertStatus(302)->assertSessionHas(['status' => 'property-like-toggled']);

        $this->assertCount(1, $property->fresh()->likes);

        $response = $this->actingAs($this->user)->post(route('properties.like', ['property' => $property, 'lang' => app()->currentLocale()]))
        ->assertStatus(302)->assertSessionHas(['status' => 'property-like-toggled']);

        $this->assertCount(0, $property->fresh()->likes);

        $property1 = Property::factory()->create();

        $response = $this->actingAs($this->user)->post(route('properties.like', ['property' => $property1, 'lang' => app()->currentLocale()]))
        ->assertStatus(302)->assertSessionHas(['status' => 'property-like-toggled']);
        $this->assertCount(1, $property1->fresh()->likes);
        $response = $this->actingAs(User::factory()->create())->post(route('properties.like', ['property' => $property1, 'lang' => app()->currentLocale()]))
        ->assertStatus(302)->assertSessionHas(['status' => 'property-like-toggled']);
        $this->assertCount(2, $property1->fresh()->likes);
        $this->assertCount(0, $property->fresh()->likes);


    }
}
