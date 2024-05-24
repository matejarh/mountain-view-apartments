<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
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
            'user_id' => User::factory()->create(),
            'property_id' => Property::factory()->create(),
            'arrival' => null,
            'departure' => null,
            'guests' => [
                'adults' => fake()->randomElement([1,2,3,4]),
                'children' => fake()->randomElement([0,1,2,3,4]),
                'pets' => fake()->randomElement([true, false]),
            ],
            'message' => fake(app()->currentLocale())->sentence(),
            'confirmed_at' => null,
            'payment_received_at' => null,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Reservation $reservation) {
            // Get the last created reservation
            $lastReservation = Reservation::latest('departure')->first();

            if ($lastReservation) {
                $arrival = \Carbon\Carbon::parse($lastReservation->departure)->format('Y-m-d') . ' 16:00:00';
            } else {
                // If there are no reservations, start from today
                $arrival = \Carbon\Carbon::now()->addDay()->format('Y-m-d') . ' 16:00:00';
            }

            $departure = \Carbon\Carbon::parse($arrival)->addDays(rand(1, 7))->format('Y-m-d') . ' 10:00:00';

            $reservation->forceFill([
                'arrival' => $arrival,
                'departure' => $departure,
            ])->save();
        });
    }
}
