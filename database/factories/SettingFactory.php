<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->sentence(3);

        return [
            'slug' => str($name),
            'name' => $name,
            'description'=>fake()->paragraph(),
            'attributes'=> [
                'attribute1' => 'setting1',
            ],
        ];
    }
}
