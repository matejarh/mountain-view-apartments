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
            'user_id' => User::factory(),
            'type' => fake()->randomElement($types),
            'slug' => str(fake('sl_SI')->sentence())->slug(),
            'name' => fake('sl_SI')->sentence(),
            'address' => fake('sl_SI')->address(),
            'description' => fake('sl_SI')->paragraphs(3, true),
            'keywords' => fake('sl_SI')->words(5, true),
            'is_entire_apartment' => fake()->randomElement([true, false]),

            'bed_types' => [
                'bedroom' => ['name' => '1 queen bed', 'icon' => 'QueenBedIcon'],
                'living_room' => ['name' => '1 sofa bed', 'icon' => 'SofaBedIcon'],
            ],
            'recomended' => [

            ],
            'prices' => [

            ],
            'rules' => [

            ],
        ];
    }
}
