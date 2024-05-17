<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inquiry>
 */
class InquiryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'property_id'=> Property::factory()->create(),
            'name' => fake()->name,
            'slug' => fake()->slug,
            'email' => fake()->email,
            'phone' => fake()->phoneNumber(),
            'adults' => fake()->randomElement([1,2,3,4]),
            'children' => fake()->randomElement([1,2,3,4]),
            'pets' => fake()->randomElement([1,0]),
            'subject' => fake()->sentence(),
            'message' => fake()->sentences(3, true),
            'date' => [now(), now()->addWeek()],
        ];
    }
}
