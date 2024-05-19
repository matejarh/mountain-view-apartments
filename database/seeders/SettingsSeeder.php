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
        Setting::factory()->create([
            'name' => 'Company info',
            'slug' => str('Company info')->slug(),
            'description' => 'Set up company info that is shown in footers or headers',
            'attributes' => [
                'company_name' => 'Klemen Apartments',
                'address' => 'Zgornje gorje 26/A',
                'city' => '4247 Bled',
                'country' => 'Slovenija',
                'phone' => '+386 41 262 549',
                'email' => 'oblikovanje.zvoka@gmail.com',
                'extra_info' => '',
            ],
        ]);
    }
}
