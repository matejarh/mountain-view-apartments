<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ExportPropertiesGalleriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('properties_galleries')->delete();
        
        \DB::table('properties_galleries')->insert(array (
            0 => 
            array (
                'id' => 1,
                'property_id' => 1,
                'gallery_id' => 5,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'property_id' => 3,
                'gallery_id' => 6,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'property_id' => 2,
                'gallery_id' => 7,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'property_id' => 4,
                'gallery_id' => 11,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}