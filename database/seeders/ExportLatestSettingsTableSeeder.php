<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ExportLatestSettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('settings')->delete();
        
        \DB::table('settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'slug' => 'site-backgrounds',
                'name' => 'Site backgrounds',
                'description' => 'Backgrounds for site',
                'attributes' => '{"autumn": {"photo_url": "http://localhost:8000/storage/galleries-photos/test-admin/4af1fb1a278b345e26ceb06aaff8f3008559bf9f9d110fbc1241e54bcfce6c06.jpg", "thumb_url": "http://localhost:8000/storage/galleries-photos/test-admin/thumbs/4af1fb1a278b345e26ceb06aaff8f3008559bf9f9d110fbc1241e54bcfce6c06.jpg"}, "spring": {"photo_url": "http://localhost:8000/storage/galleries-photos/test-admin/989ce257afae3e0fa57a6758d64abd10e9652f070a102b4d075b4ef434322dc3.jpg", "thumb_url": "http://localhost:8000/storage/galleries-photos/test-admin/thumbs/989ce257afae3e0fa57a6758d64abd10e9652f070a102b4d075b4ef434322dc3.jpg"}, "summer": {"photo_url": "http://localhost:8000/storage/galleries-photos/test-admin/35c1d23d6de66417723a8f3beb58e5800a87684a9b0435ae1b0034e088d0f2da.jpg", "thumb_url": "http://localhost:8000/storage/galleries-photos/test-admin/thumbs/35c1d23d6de66417723a8f3beb58e5800a87684a9b0435ae1b0034e088d0f2da.jpg"}, "winter": null}',
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-21 17:35:53',
            ),
            1 => 
            array (
                'id' => 2,
                'slug' => 'datepicker-range',
                'name' => 'Datepicker range',
                'description' => 'Set up min and max days available for booking',
                'attributes' => '{"max": 7, "min": 2}',
                'created_at' => '2024-05-19 11:05:00',
                'updated_at' => '2024-05-19 11:05:00',
            ),
            2 => 
            array (
                'id' => 3,
                'slug' => 'company-info',
                'name' => 'Company info',
                'description' => 'Set up company info that is shown in footers or headers',
                'attributes' => '{"city": "4247 Bled", "email": "oblikovanje.zvoka@gmail.com", "phone": "+386 41 262 549", "address": "Zgornje gorje 26/A", "country": "Slovenija", "extra_info": null, "company_name": "Klemen Apartments"}',
                'created_at' => '2024-05-19 11:39:36',
                'updated_at' => '2024-05-19 11:50:38',
            ),
            3 => 
            array (
                'id' => 4,
                'slug' => 'intervals',
                'name' => 'Intervals',
                'description' => 'Set up intervals for automatic background image switch in seconds',
                'attributes' => '{"hero_background_interval": 10}',
                'created_at' => '2024-05-20 23:56:38',
                'updated_at' => '2024-05-20 23:56:38',
            ),
        ));
        
        
    }
}