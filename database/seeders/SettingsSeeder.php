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
    }
}
