<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gallery>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->uuid(),
            'notifiable_id' => User::factory(),
            'notifiable_type' => 'App\Models\User',
            'type' => 'App\Notifications\TestNotification',
            'data' => '{"title":"Test","message":"Test message","link":"#"}',
            'read_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
