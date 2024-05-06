<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Facility>
 */
class FacilityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->randomElement($this->facilities());
        return [
            'name' => $name,
            'slug' => str($name)->slug(),
            'icon' => str($name)->replace('-', ' ')->replace('/', ' ')->title()->replace(' ', '') . 'Icon',
            'text' => null,
        ];
    }

    private function facilities() : array {
        return [
            "Non-smoking rooms",
            "Free parking",
            "Family rooms",
            "Skiing",
            "Private beach area",
            "Entire apartment",
            "Private kitchen",
            "Attached bathroom",
            "Balcony",
            "Garden view",
            "Mountain view",
            "Inner courtyard view",
            "Patio",
            "Flat-screen TV",
            "Terrace",
            "Coffee machine",
            "Kitchen",
            "Safe Deposit Box",
            "Toilet",
            "Sofa",
            "Bath or Shower",
            "Towels",
            "Linen",
            "socket near the bed",
            "Cleaning products",
            "Tiled / Marble floor",
            "Seating area",
            "Trouser Press",
            "TV",
            "Refrigerator",
            "Mosquito Net",
            "Ironing facilities",
            "Coffee/Tea maker",
            "Clothing Iron",
            "Heating",
            "Hair Dryer",
            "Kitchenware",
            "DVD-Player",
            "Dressing room",
            "CD-Player",
            "Carpeted Floor",
            "Electric Kettle",
            "Outdoor furniture",
            "Outdoor dining area",
            "Cable channels",
            "Laptop Safe Box",
            "Wardrobe/Closet",
            "Oven",
            "Stove",
            "Toaster",
            "Dining Area",
            "Dining table",
            "Upper floor reachable by stairs only",
            "Detached",
            "Private flat in block of flats",
            "Clothes Rack",
            "Clothes drying rack",
            "Toilet paper",
            "Board games/puzzles",
            "Sofa bed",
            "Hand sanitizer in room",
        ];
    }
}
