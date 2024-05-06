<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Property::factory()->create($this->nassfeld());
    }

    private function nassfeld() : array {
        return [
            'user_id' => 2,
            'type' => "One-Bedroom Apartment",
            'slug' => str("Nassfeld and Lake Apartment")->slug(),
            'name' => "Nassfeld and Lake Apartment",
            'address' => '61 Neudorf 1, 9620 Hermagor, Austria',
            'description' => "Featuring a garden, Nassfeld and Lake Apartment offers accommodations in Hermagor. This property offers access to a balcony and free private parking. The accommodation provides private check-in and check-out and bicycle parking for guests.",
            'keywords' => "accommodations, Hermagor ",
            'is_entire_apartment' => true,

            'bed_types' => [
                'bedroom' => ['name'=>'1 queen bed', 'icon' => 'QueenBedIcon'],
                'living_room' => ['name'=>'1 sofa bed', 'icon' => 'SofaBedIcon'],
            ],
            'recomended' => [
                'for 4 adults',
            ],
            'prices' => [
                ['guests' => 4, 'price' => "945"],
                ['guests' => 3, 'price' => "883"],
                ['guests' => 2, 'price' => "846"],
                ['guests' => 1, 'price' => "810"],
            ],
            'rules' => [
                ['name' => 'Check In', 'title' => 'From 4:00 PM to 12:00 AM', 'description' => 'You need to let the property know what time you\'ll be arriving in advance.', 'icon' => 'CheckInIcon'],
                ['name' => 'Check Out', 'title' => 'From 12:00 AM to 10:00 AM', 'description' => '', 'icon' => 'CheckOutIcon'],
                ['name' => 'Cancellation/prepayment', 'title' => '', 'description' => 'Cancellation and prepayment policies vary according to apartment type. Please check the Apartment Conditions when selecting your apartment above.', 'icon' => 'CancellationPrepaymentIcon'],
                ['name' => 'Children & Beds', 'title' => 'Child policies', 'description' => 'Children of all ages are welcome. To see correct prices and occupancy info, add the number and ages of children in your group to your search. No cribs or extra beds are available.', 'icon' => 'ChildrenBedsIcon'],
                ['name' => 'Age restriction', 'title' => '', 'description' => 'The minimum age for check-in is 18', 'icon' => 'ChildrenBedsIcon'],
                ['name' => 'Smoking', 'title' => '', 'description' => 'Smoking is not allowed.', 'icon' => 'NonSmokingRoomsIcon'],
                ['name' => 'Parties', 'title' => '', 'description' => 'Parties/events are not allowed', 'icon' => 'PartiesIcon'],
                ['name' => 'Quiet hours', 'title' => '', 'description' => 'Guests need be quiet between 10:00 PM and 7:00 AM.', 'icon' => 'QuietHoursIcon'],
                ['name' => 'Pets', 'title' => '', 'description' => 'Pets are not allowed.', 'icon' => 'QuietHoursIcon'],
            ],
        ];
    }

}
