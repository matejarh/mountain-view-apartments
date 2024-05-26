<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ExportLatestFacilitiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('facilities')->delete();
        
        \DB::table('facilities')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Non-smoking rooms',
                'slug' => 'non-smoking-rooms',
                'icon' => 'NonSmokingRoomsIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Free parking',
                'slug' => 'free-parking',
                'icon' => 'FreeParkingIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Family rooms',
                'slug' => 'family-rooms',
                'icon' => 'FamilyRoomsIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Skiing',
                'slug' => 'skiing',
                'icon' => 'SkiingIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Private beach area',
                'slug' => 'private-beach-area',
                'icon' => 'PrivateBeachAreaIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Entire apartment',
                'slug' => 'entire-apartment',
                'icon' => 'EntireApartmentIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Private kitchen',
                'slug' => 'private-kitchen',
                'icon' => 'PrivateKitchenIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Attached bathroom',
                'slug' => 'attached-bathroom',
                'icon' => 'AttachedBathroomIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Balcony',
                'slug' => 'balcony',
                'icon' => 'BalconyIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Garden view',
                'slug' => 'garden-view',
                'icon' => 'GardenViewIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Mountain view',
                'slug' => 'mountain-view',
                'icon' => 'MountainViewIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Inner courtyard view',
                'slug' => 'inner-courtyard-view',
                'icon' => 'InnerCourtyardViewIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Patio',
                'slug' => 'patio',
                'icon' => 'PatioIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Flat-screen TV',
                'slug' => 'flat-screen-tv',
                'icon' => 'FlatScreenTvIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Terrace',
                'slug' => 'terrace',
                'icon' => 'TerraceIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Coffee machine',
                'slug' => 'coffee-machine',
                'icon' => 'CoffeeMachineIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Kitchen',
                'slug' => 'kitchen',
                'icon' => 'KitchenIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Safe Deposit Box',
                'slug' => 'safe-deposit-box',
                'icon' => 'SafeDepositBoxIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Toilet',
                'slug' => 'toilet',
                'icon' => 'ToiletIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Sofa',
                'slug' => 'sofa',
                'icon' => 'SofaIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Bath or Shower',
                'slug' => 'bath-or-shower',
                'icon' => 'BathOrShowerIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Towels',
                'slug' => 'towels',
                'icon' => 'TowelsIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'Linen',
                'slug' => 'linen',
                'icon' => 'LinenIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'Socket near the bed',
                'slug' => 'socket-near-the-bed',
                'icon' => 'SocketNearTheBedIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'Cleaning products',
                'slug' => 'cleaning-products',
                'icon' => 'CleaningProductsIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'Tiled / Marble floor',
                'slug' => 'tiled-marble-floor',
                'icon' => 'TiledMarbleFloorIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'Seating area',
                'slug' => 'seating-area',
                'icon' => 'SeatingAreaIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'Trouser Press',
                'slug' => 'trouser-press',
                'icon' => 'TrouserPressIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'TV',
                'slug' => 'tv',
                'icon' => 'TvIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'Refrigerator',
                'slug' => 'refrigerator',
                'icon' => 'RefrigeratorIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'Mosquito Net',
                'slug' => 'mosquito-net',
                'icon' => 'MosquitoNetIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'Ironing facilities',
                'slug' => 'ironing-facilities',
                'icon' => 'IroningFacilitiesIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'Coffee/Tea maker',
                'slug' => 'coffeetea-maker',
                'icon' => 'CoffeeTeaMakerIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'Clothing Iron',
                'slug' => 'clothing-iron',
                'icon' => 'ClothingIronIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'Heating',
                'slug' => 'heating',
                'icon' => 'HeatingIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'Hair Dryer',
                'slug' => 'hair-dryer',
                'icon' => 'HairDryerIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'Kitchenware',
                'slug' => 'kitchenware',
                'icon' => 'KitchenwareIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'DVD-Player',
                'slug' => 'dvd-player',
                'icon' => 'DvdPlayerIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'Dressing room',
                'slug' => 'dressing-room',
                'icon' => 'DressingRoomIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'CD-Player',
                'slug' => 'cd-player',
                'icon' => 'CdPlayerIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            40 => 
            array (
                'id' => 41,
                'name' => 'Carpeted Floor',
                'slug' => 'carpeted-floor',
                'icon' => 'CarpetedFloorIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            41 => 
            array (
                'id' => 42,
                'name' => 'Electric Kettle',
                'slug' => 'electric-kettle',
                'icon' => 'ElectricKettleIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            42 => 
            array (
                'id' => 43,
                'name' => 'Outdoor furniture',
                'slug' => 'outdoor-furniture',
                'icon' => 'OutdoorFurnitureIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            43 => 
            array (
                'id' => 44,
                'name' => 'Outdoor dining area',
                'slug' => 'outdoor-dining-area',
                'icon' => 'OutdoorDiningAreaIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            44 => 
            array (
                'id' => 45,
                'name' => 'Cable channels',
                'slug' => 'cable-channels',
                'icon' => 'CableChannelsIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            45 => 
            array (
                'id' => 46,
                'name' => 'Laptop Safe Box',
                'slug' => 'laptop-safe-box',
                'icon' => 'LaptopSafeBoxIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            46 => 
            array (
                'id' => 47,
                'name' => 'Wardrobe/Closet',
                'slug' => 'wardrobecloset',
                'icon' => 'WardrobeClosetIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            47 => 
            array (
                'id' => 48,
                'name' => 'Oven',
                'slug' => 'oven',
                'icon' => 'OvenIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            48 => 
            array (
                'id' => 49,
                'name' => 'Stove',
                'slug' => 'stove',
                'icon' => 'StoveIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            49 => 
            array (
                'id' => 50,
                'name' => 'Toaster',
                'slug' => 'toaster',
                'icon' => 'ToasterIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            50 => 
            array (
                'id' => 51,
                'name' => 'Dining Area',
                'slug' => 'dining-area',
                'icon' => 'DiningAreaIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            51 => 
            array (
                'id' => 52,
                'name' => 'Dining table',
                'slug' => 'dining-table',
                'icon' => 'DiningTableIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            52 => 
            array (
                'id' => 53,
                'name' => 'Upper floor reachable by stairs only',
                'slug' => 'upper-floor-reachable-by-stairs-only',
                'icon' => 'UpperFloorReachableByStairsOnlyIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            53 => 
            array (
                'id' => 54,
                'name' => 'Detached',
                'slug' => 'detached',
                'icon' => 'DetachedIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            54 => 
            array (
                'id' => 55,
                'name' => 'Private flat in block of flats',
                'slug' => 'private-flat-in-block-of-flats',
                'icon' => 'PrivateFlatInBlockOfFlatsIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            55 => 
            array (
                'id' => 56,
                'name' => 'Clothes Rack',
                'slug' => 'clothes-rack',
                'icon' => 'ClothesRackIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            56 => 
            array (
                'id' => 57,
                'name' => 'Clothes drying rack',
                'slug' => 'clothes-drying-rack',
                'icon' => 'ClothesDryingRackIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            57 => 
            array (
                'id' => 58,
                'name' => 'Toilet paper',
                'slug' => 'toilet-paper',
                'icon' => 'ToiletPaperIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            58 => 
            array (
                'id' => 59,
                'name' => 'Board games/puzzles',
                'slug' => 'board-gamespuzzles',
                'icon' => 'BoardGamesPuzzlesIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            59 => 
            array (
                'id' => 60,
                'name' => 'Sofa bed',
                'slug' => 'sofa-bed',
                'icon' => 'SofaBedIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            60 => 
            array (
                'id' => 61,
                'name' => 'Hand sanitizer in room',
                'slug' => 'hand-sanitizer-in-room',
                'icon' => 'HandSanitizerInRoomIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            61 => 
            array (
                'id' => 62,
                'name' => 'Fully equiped kitchen',
                'slug' => 'fully-equiped-kitchen',
                'icon' => 'FullyEquipedKitchenIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            62 => 
            array (
                'id' => 63,
                'name' => 'Free Wi-Fi',
                'slug' => 'free-wi-fi',
                'icon' => 'FreeWiFiIcon',
                'text' => NULL,
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
        ));
        
        
    }
}