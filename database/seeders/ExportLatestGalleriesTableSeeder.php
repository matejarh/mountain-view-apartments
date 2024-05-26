<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ExportLatestGalleriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('galleries')->delete();
        
        \DB::table('galleries')->insert(array (
            0 => 
            array (
                'id' => 4,
                'user_id' => 1,
                'slug' => 'home-page-hero',
                'name' => 'Home Page Hero',
                'description' => NULL,
                'created_at' => '2024-05-10 21:58:40',
                'updated_at' => '2024-05-10 21:58:40',
            ),
            1 => 
            array (
                'id' => 5,
                'user_id' => 1,
                'slug' => 'nassfeld-and-lake-apartment',
                'name' => 'Nassfeld and Lake Apartment',
                'description' => NULL,
                'created_at' => '2024-05-10 22:28:26',
                'updated_at' => '2024-05-10 22:28:26',
            ),
            2 => 
            array (
                'id' => 6,
                'user_id' => 1,
                'slug' => 'apartment-tree',
                'name' => 'Apartment Two Angels',
                'description' => NULL,
                'created_at' => '2024-05-18 17:34:18',
                'updated_at' => '2024-05-18 18:18:46',
            ),
            3 => 
            array (
                'id' => 7,
                'user_id' => 1,
                'slug' => 'apartment-two-angels',
                'name' => 'Apartment Tree',
                'description' => NULL,
                'created_at' => '2024-05-18 17:34:30',
                'updated_at' => '2024-05-18 17:38:43',
            ),
            4 => 
            array (
                'id' => 8,
                'user_id' => 1,
                'slug' => 'discover-bled',
                'name' => 'Explore Bled',
                'description' => NULL,
                'created_at' => '2024-05-20 11:06:09',
                'updated_at' => '2024-05-20 11:07:54',
            ),
            5 => 
            array (
                'id' => 9,
                'user_id' => 1,
                'slug' => 'discover-nassfeld',
                'name' => 'Discover Nassfeld',
                'description' => NULL,
                'created_at' => '2024-05-20 16:31:06',
                'updated_at' => '2024-05-20 16:31:06',
            ),
            6 => 
            array (
                'id' => 10,
                'user_id' => 1,
                'slug' => 'about-us',
                'name' => 'About Us',
                'description' => NULL,
                'created_at' => '2024-05-25 23:31:52',
                'updated_at' => '2024-05-25 23:31:52',
            ),
        ));
        
        
    }
}