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
                'id' => 1,
                'gallery_id' => 4,
                'page_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}