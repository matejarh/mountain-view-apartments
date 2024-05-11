<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $languages = ['sl', 'en', 'de', 'hu', 'it', 'fr', 'cs'];

        $titles = [];

        foreach ($languages as $key => $language) {
            //array_push($titles, [$language => fake($language)->sentence]);
            $titles[$language] = '';
        }

        $descriptions = [];

        foreach ($languages as $key => $language) {
            //array_push($descriptions, [$language => fake($language)->paragraph()]);
            $descriptions[$language] = '';
        }

        $keywords = [];

        foreach ($languages as $key => $language) {
            //array_push($keywords, [$language => str(fake()->words(6, true))->replace(' ', ', ')]);
            $keywords[$language] = '';
        }
        $name = fake()->sentence(3);

        return [
            'name' => $name,
            'slug' => str($name)->slug(),
            'title' => $titles,
            'description' => $descriptions,
            'keywords' => $keywords,
        ];
    }
}
