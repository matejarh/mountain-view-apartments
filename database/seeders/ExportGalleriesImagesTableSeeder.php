<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ExportGalleriesImagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('galleries_images')->delete();
        
        \DB::table('galleries_images')->insert(array (
            0 => 
            array (
                'id' => 13,
                'gallery_id' => 4,
                'image_id' => 2,
                'order' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 14,
                'gallery_id' => 4,
                'image_id' => 1,
                'order' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 16,
                'gallery_id' => 5,
                'image_id' => 12,
                'order' => 1,
                'created_at' => NULL,
                'updated_at' => '2024-05-15 06:30:18',
            ),
            3 => 
            array (
                'id' => 17,
                'gallery_id' => 5,
                'image_id' => 11,
                'order' => 7,
                'created_at' => NULL,
                'updated_at' => '2024-05-15 07:24:42',
            ),
            4 => 
            array (
                'id' => 18,
                'gallery_id' => 5,
                'image_id' => 10,
                'order' => 9,
                'created_at' => NULL,
                'updated_at' => '2024-05-15 07:21:58',
            ),
            5 => 
            array (
                'id' => 19,
                'gallery_id' => 5,
                'image_id' => 9,
                'order' => 11,
                'created_at' => NULL,
                'updated_at' => '2024-05-15 07:21:58',
            ),
            6 => 
            array (
                'id' => 20,
                'gallery_id' => 5,
                'image_id' => 8,
                'order' => 14,
                'created_at' => NULL,
                'updated_at' => '2024-05-15 07:21:58',
            ),
            7 => 
            array (
                'id' => 21,
                'gallery_id' => 5,
                'image_id' => 7,
                'order' => 10,
                'created_at' => NULL,
                'updated_at' => '2024-05-15 07:21:58',
            ),
            8 => 
            array (
                'id' => 22,
                'gallery_id' => 5,
                'image_id' => 5,
                'order' => 2,
                'created_at' => NULL,
                'updated_at' => '2024-05-15 07:21:58',
            ),
            9 => 
            array (
                'id' => 23,
                'gallery_id' => 5,
                'image_id' => 6,
                'order' => 5,
                'created_at' => '2024-05-14 18:02:33',
                'updated_at' => '2024-05-15 07:24:46',
            ),
            10 => 
            array (
                'id' => 24,
                'gallery_id' => 5,
                'image_id' => 14,
                'order' => 13,
                'created_at' => '2024-05-15 04:39:28',
                'updated_at' => '2024-05-15 07:21:58',
            ),
            11 => 
            array (
                'id' => 25,
                'gallery_id' => 5,
                'image_id' => 15,
                'order' => 4,
                'created_at' => '2024-05-15 04:40:15',
                'updated_at' => '2024-05-15 07:21:58',
            ),
            12 => 
            array (
                'id' => 26,
                'gallery_id' => 5,
                'image_id' => 16,
                'order' => 8,
                'created_at' => '2024-05-15 04:40:55',
                'updated_at' => '2024-05-15 07:21:58',
            ),
            13 => 
            array (
                'id' => 27,
                'gallery_id' => 5,
                'image_id' => 17,
                'order' => 6,
                'created_at' => '2024-05-15 04:41:51',
                'updated_at' => '2024-05-15 07:24:46',
            ),
            14 => 
            array (
                'id' => 28,
                'gallery_id' => 5,
                'image_id' => 18,
                'order' => 3,
                'created_at' => '2024-05-15 04:44:03',
                'updated_at' => '2024-05-15 07:21:58',
            ),
            15 => 
            array (
                'id' => 29,
                'gallery_id' => 5,
                'image_id' => 19,
                'order' => 12,
                'created_at' => '2024-05-15 07:17:37',
                'updated_at' => '2024-05-15 07:21:58',
            ),
            16 => 
            array (
                'id' => 30,
                'gallery_id' => 5,
                'image_id' => 13,
                'order' => 15,
                'created_at' => '2024-05-15 07:24:57',
                'updated_at' => '2024-05-15 07:24:57',
            ),
            17 => 
            array (
                'id' => 31,
                'gallery_id' => 6,
                'image_id' => 29,
                'order' => 1,
                'created_at' => '2024-05-18 17:36:53',
                'updated_at' => '2024-05-18 17:36:53',
            ),
            18 => 
            array (
                'id' => 32,
                'gallery_id' => 6,
                'image_id' => 28,
                'order' => 2,
                'created_at' => '2024-05-18 17:36:58',
                'updated_at' => '2024-05-18 17:36:58',
            ),
            19 => 
            array (
                'id' => 33,
                'gallery_id' => 6,
                'image_id' => 27,
                'order' => 3,
                'created_at' => '2024-05-18 17:37:01',
                'updated_at' => '2024-05-18 17:37:01',
            ),
            20 => 
            array (
                'id' => 34,
                'gallery_id' => 6,
                'image_id' => 26,
                'order' => 5,
                'created_at' => '2024-05-18 17:37:04',
                'updated_at' => '2024-05-18 18:28:03',
            ),
            21 => 
            array (
                'id' => 35,
                'gallery_id' => 6,
                'image_id' => 25,
                'order' => 6,
                'created_at' => '2024-05-18 17:37:07',
                'updated_at' => '2024-05-18 18:28:02',
            ),
            22 => 
            array (
                'id' => 36,
                'gallery_id' => 6,
                'image_id' => 24,
                'order' => 8,
                'created_at' => '2024-05-18 17:37:10',
                'updated_at' => '2024-05-18 18:28:41',
            ),
            23 => 
            array (
                'id' => 37,
                'gallery_id' => 6,
                'image_id' => 23,
                'order' => 4,
                'created_at' => '2024-05-18 17:37:12',
                'updated_at' => '2024-05-18 18:28:03',
            ),
            24 => 
            array (
                'id' => 38,
                'gallery_id' => 6,
                'image_id' => 22,
                'order' => 11,
                'created_at' => '2024-05-18 17:37:15',
                'updated_at' => '2024-05-18 18:28:36',
            ),
            25 => 
            array (
                'id' => 39,
                'gallery_id' => 6,
                'image_id' => 21,
                'order' => 9,
                'created_at' => '2024-05-18 17:37:18',
                'updated_at' => '2024-05-18 18:28:40',
            ),
            26 => 
            array (
                'id' => 40,
                'gallery_id' => 6,
                'image_id' => 20,
                'order' => 13,
                'created_at' => '2024-05-18 17:37:21',
                'updated_at' => '2024-05-18 18:28:31',
            ),
            27 => 
            array (
                'id' => 41,
                'gallery_id' => 7,
                'image_id' => 40,
                'order' => 1,
                'created_at' => '2024-05-18 17:42:25',
                'updated_at' => '2024-05-18 17:42:25',
            ),
            28 => 
            array (
                'id' => 42,
                'gallery_id' => 7,
                'image_id' => 46,
                'order' => 2,
                'created_at' => '2024-05-18 17:42:28',
                'updated_at' => '2024-05-18 17:42:28',
            ),
            29 => 
            array (
                'id' => 43,
                'gallery_id' => 7,
                'image_id' => 47,
                'order' => 3,
                'created_at' => '2024-05-18 17:42:31',
                'updated_at' => '2024-05-18 17:42:31',
            ),
            30 => 
            array (
                'id' => 44,
                'gallery_id' => 7,
                'image_id' => 48,
                'order' => 4,
                'created_at' => '2024-05-18 17:42:34',
                'updated_at' => '2024-05-18 17:42:34',
            ),
            31 => 
            array (
                'id' => 45,
                'gallery_id' => 7,
                'image_id' => 49,
                'order' => 5,
                'created_at' => '2024-05-18 17:42:37',
                'updated_at' => '2024-05-18 17:42:37',
            ),
            32 => 
            array (
                'id' => 46,
                'gallery_id' => 7,
                'image_id' => 45,
                'order' => 6,
                'created_at' => '2024-05-18 17:42:40',
                'updated_at' => '2024-05-18 17:42:40',
            ),
            33 => 
            array (
                'id' => 47,
                'gallery_id' => 7,
                'image_id' => 44,
                'order' => 7,
                'created_at' => '2024-05-18 17:42:43',
                'updated_at' => '2024-05-18 17:42:43',
            ),
            34 => 
            array (
                'id' => 48,
                'gallery_id' => 7,
                'image_id' => 43,
                'order' => 8,
                'created_at' => '2024-05-18 17:42:45',
                'updated_at' => '2024-05-18 17:42:45',
            ),
            35 => 
            array (
                'id' => 49,
                'gallery_id' => 7,
                'image_id' => 42,
                'order' => 9,
                'created_at' => '2024-05-18 17:42:48',
                'updated_at' => '2024-05-18 17:42:48',
            ),
            36 => 
            array (
                'id' => 50,
                'gallery_id' => 7,
                'image_id' => 41,
                'order' => 10,
                'created_at' => '2024-05-18 17:42:50',
                'updated_at' => '2024-05-18 17:42:50',
            ),
            37 => 
            array (
                'id' => 51,
                'gallery_id' => 7,
                'image_id' => 39,
                'order' => 11,
                'created_at' => '2024-05-18 17:42:52',
                'updated_at' => '2024-05-18 17:42:52',
            ),
            38 => 
            array (
                'id' => 52,
                'gallery_id' => 7,
                'image_id' => 38,
                'order' => 12,
                'created_at' => '2024-05-18 17:42:54',
                'updated_at' => '2024-05-18 17:42:54',
            ),
            39 => 
            array (
                'id' => 53,
                'gallery_id' => 7,
                'image_id' => 37,
                'order' => 13,
                'created_at' => '2024-05-18 17:42:57',
                'updated_at' => '2024-05-18 17:42:57',
            ),
            40 => 
            array (
                'id' => 54,
                'gallery_id' => 7,
                'image_id' => 36,
                'order' => 14,
                'created_at' => '2024-05-18 17:42:59',
                'updated_at' => '2024-05-18 17:42:59',
            ),
            41 => 
            array (
                'id' => 55,
                'gallery_id' => 7,
                'image_id' => 35,
                'order' => 15,
                'created_at' => '2024-05-18 17:43:02',
                'updated_at' => '2024-05-18 17:43:02',
            ),
            42 => 
            array (
                'id' => 56,
                'gallery_id' => 7,
                'image_id' => 30,
                'order' => 16,
                'created_at' => '2024-05-18 17:43:04',
                'updated_at' => '2024-05-18 17:43:04',
            ),
            43 => 
            array (
                'id' => 57,
                'gallery_id' => 7,
                'image_id' => 31,
                'order' => 17,
                'created_at' => '2024-05-18 17:43:08',
                'updated_at' => '2024-05-18 17:43:08',
            ),
            44 => 
            array (
                'id' => 58,
                'gallery_id' => 7,
                'image_id' => 32,
                'order' => 18,
                'created_at' => '2024-05-18 17:43:11',
                'updated_at' => '2024-05-18 17:43:11',
            ),
            45 => 
            array (
                'id' => 59,
                'gallery_id' => 7,
                'image_id' => 33,
                'order' => 19,
                'created_at' => '2024-05-18 17:43:15',
                'updated_at' => '2024-05-18 17:43:15',
            ),
            46 => 
            array (
                'id' => 60,
                'gallery_id' => 7,
                'image_id' => 34,
                'order' => 20,
                'created_at' => '2024-05-18 17:43:17',
                'updated_at' => '2024-05-18 17:43:17',
            ),
            47 => 
            array (
                'id' => 61,
                'gallery_id' => 6,
                'image_id' => 39,
                'order' => 10,
                'created_at' => '2024-05-18 18:01:37',
                'updated_at' => '2024-05-18 18:28:38',
            ),
            48 => 
            array (
                'id' => 62,
                'gallery_id' => 6,
                'image_id' => 32,
                'order' => 7,
                'created_at' => '2024-05-18 18:01:41',
                'updated_at' => '2024-05-18 18:28:41',
            ),
            49 => 
            array (
                'id' => 63,
                'gallery_id' => 6,
                'image_id' => 33,
                'order' => 12,
                'created_at' => '2024-05-18 18:01:45',
                'updated_at' => '2024-05-18 18:28:31',
            ),
            50 => 
            array (
                'id' => 64,
                'gallery_id' => 6,
                'image_id' => 38,
                'order' => 14,
                'created_at' => '2024-05-18 18:01:51',
                'updated_at' => '2024-05-18 18:01:51',
            ),
            51 => 
            array (
                'id' => 65,
                'gallery_id' => 6,
                'image_id' => 49,
                'order' => 15,
                'created_at' => '2024-05-18 18:01:54',
                'updated_at' => '2024-05-18 18:01:54',
            ),
            52 => 
            array (
                'id' => 66,
                'gallery_id' => 6,
                'image_id' => 42,
                'order' => 16,
                'created_at' => '2024-05-18 18:02:01',
                'updated_at' => '2024-05-18 18:02:01',
            ),
        ));
        
        
    }
}