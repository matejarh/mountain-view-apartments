<?php

namespace Tests\Feature;

use App\Models\Facility;
use App\Models\Gallery;
use App\Models\Property;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PropertiesTest extends TestCase
{
    use RefreshDatabase;


    public function test_properties_screen_may_be_rendered_for_guest(): void
    {
        $response = $this->get(route('properties.index', app()->currentLocale()))
            ->assertStatus(200)
            ->assertSee('properties');
    }

    public function test_specific_property_screen_may_be_rendered_for_guest(): void
    {
        $property = Property::factory()->create();

        $response = $this->get(route('properties.show', [app()->currentLocale(), $property]))
            ->assertStatus(200)
            ->assertSee('latest_reviews')
            ->assertSee('current_prices')
            ->assertSee('unavailable_dates')
            ->assertSee('property');
    }

    public function test_properties_screen_may_be_rendered_for_user(): void
    {

        $response = $this->actingAs($this->user)->get(route('properties.index', app()->currentLocale()))
            ->assertStatus(200)
            ->assertSee('properties');
    }

    public function test_properties_screen_may_be_rendered_for_admin(): void
    {

        $response = $this->actingAs($this->admin)->get(route('properties.index', app()->currentLocale()))
            ->assertStatus(200)
            ->assertSee('properties');
    }


}
