<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = [
            'Two Bedroom Apartment',
            'One Bedroom Apartment',
        ];

        return [
            'owner_id' => User::factory()->create()->id,
            'type' => fake()->randomElement($types),
            'slug' => str(fake()->sentence())->slug(),
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'keywords' => fake()->words(5, true),
        ];
    }
}
