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

        $languages = ['sl', 'en', 'de', 'hu', 'it', 'fr', 'cs'];

        $titles = [];

        foreach ($languages as $key => $language) {
            //array_push($titles, [$language => fake($language)->sentence]);
            $titles[$language] = fake($language)->sentence();
        }

        $descriptions = [];

        foreach ($languages as $key => $language) {
            //array_push($descriptions, [$language => fake($language)->paragraph()]);
            $descriptions[$language] = fake($language)->paragraph();
        }

        $quotes = [];

        foreach ($languages as $key => $language) {
            //array_push($quotes, [$language => fake($language)->paragraph()]);
            $quotes[$language] = fake($language)->paragraph();
        }

        $keywords = [];

        foreach ($languages as $key => $language) {
            //array_push($keywords, [$language => str(fake()->words(6, true))->replace(' ', ', ')]);
            $keywords[$language] = str(fake()->words(6, true))->replace(' ', ', ');
        }

        $rules = [];

        foreach ($languages as $key => $language) {
            //array_push($keywords, [$language => str(fake()->words(6, true))->replace(' ', ', ')]);
            $rules[$language] = [];
        }


        $name = fake()->sentence(3);

        return [
            'user_id' => User::factory(),
            'type' => fake()->randomElement($types),
            'slug' => str($name)->slug(),
            'name' => $name,
            'address' => fake('sl_SI')->address(),
            'title' => $titles,
            'description' => $descriptions,
            'quote' => $quotes,
            'keywords' => $keywords,
            'is_entire_apartment' => fake()->randomElement([true, false]),
            'coordinates' => [
                'lat' => 0,
                'lng' => 0,
            ],
            'bed_types' => [
                ['title' => 'bedroom', 'name'=>'1 queen bed', 'icon' => 'QueenBedIcon'],
                ['title' => 'living_room', 'name'=>'1 sofa bed', 'icon' => 'SofaBedIcon'],
            ],
            'recomended' => [
                ['title' => 'test title'],
            ],
            'rules' => $rules,
        ];
    }
}
