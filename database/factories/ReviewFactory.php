<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create(),
            'reviewed_id' => Property::factory()->create(),
            'reviewed_type' => 'App\Models\Property',
            'score' => fake()->randomElement([1,2,3,4,5]),
            'text' => fake()->sentence(),
        ];
    }
}
