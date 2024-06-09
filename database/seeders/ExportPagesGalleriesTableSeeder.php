<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ExportPagesGalleriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pages_galleries')->delete();
        
        \DB::table('pages_galleries')->insert(array (
            0 => 
            array (
                'id' => 10,
                'gallery_id' => 8,
                'page_id' => 3,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 11,
                'gallery_id' => 9,
                'page_id' => 4,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 12,
                'gallery_id' => 10,
                'page_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 15,
                'gallery_id' => 4,
                'page_id' => 11,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}