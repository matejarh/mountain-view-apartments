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
                'gallery_id' => 8,
                'page_id' => 7,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'gallery_id' => 9,
                'page_id' => 8,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'gallery_id' => 4,
                'page_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));


    }
}
