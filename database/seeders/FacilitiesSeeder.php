<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        foreach ($this->facilitiesList() as $key => $facility) {
            $f = [
                'name' => $facility,
                'slug' => str($facility)->slug(),
                'icon' => str($facility)->replace('-', ' ')->replace('/', ' ')->title()->replace(' ', '') . 'Icon'
            ];
            // array_push($propertyFacilities, $f);
            Facility::factory()->create($f);
        }
    }

    private function facilitiesList() : array {
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
           "Socket near the bed",
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
