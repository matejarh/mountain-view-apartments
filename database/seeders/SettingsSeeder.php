<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::factory()->create([
            'name' => 'Site backgrounds',
            'slug' => str('Site backgrounds')->slug(),
            'description' => 'Backgrounds for site',
            'attributes' => [
                'spring' => '',
                'summer' => '',
                'autumn' => '',
                'winter' => '',
            ],
        ]);
        Setting::factory()->create([
            'name' => 'Datepicker range',
            'slug' => str('Datepicker range')->slug(),
            'description' => 'Set up min and max days available for booking',
            'attributes' => [
                'min' => 2,
                'max' => 7,
            ],
        ]);
    }
}
