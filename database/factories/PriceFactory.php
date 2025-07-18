<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Price>
 */
class PriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'property_id' => Property::factory()->create(),
            'from' => fake()->date(),
            'to' => fake()->date(),
            'discounts' => [
                ['days' => 6, 'discount' => '10%'],
            ],
            'prices' => [
                ['guests' => 1, 'price' => '65'],
                ['guests' => 2, 'price' => '75'],
            ],
        ];
    }
}
