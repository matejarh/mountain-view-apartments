<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@mountain-view-apartments.com',
            'password' => Hash::make('varnoGeslo123'),
            'is_admin' => true,
        ]);
        User::factory()->create([
            'name' => 'Developer',
            'email' => 'matej.arh@gmail.com',
            'password' => Hash::make('varnoGeslo123'),
            'is_admin' => true,
        ]);

        $this->call([
            // SettingsSeeder::class,
            // FacilitiesSeeder::class,
/*             PropertiesSeeder::class,
            PagesSeeder::class,
            GalleriesSeeder::class, */
        ]);

        $this->call(ExportLatestSettingsTableSeeder::class);
        $this->call(ExportLatestFacilitiesTableSeeder::class);
        //$this->call(ExportLatestGalleriesTableSeeder::class);
        //$this->call(ExportLatestImagesTableSeeder::class);
        //$this->call(ExportLatestPropertiesTableSeeder::class);
        //$this->call(ExportLatestPagesTableSeeder::class);
        //$this->call(ExportLatestGalleriesImagesTableSeeder::class);
        //$this->call(ExportLatestPropertiesGalleriesTableSeeder::class);
        //$this->call(ExportLatestPagesGalleriesTableSeeder::class);
        $this->call(ExportImagesTableSeeder::class);
        $this->call(ExportGalleriesTableSeeder::class);
        $this->call(ExportGalleriesImagesTableSeeder::class);
        $this->call(ExportPropertiesTableSeeder::class);
        $this->call(ExportPropertiesGalleriesTableSeeder::class);
        $this->call(ExportPagesTableSeeder::class);
        $this->call(ExportPagesGalleriesTableSeeder::class);
        $this->call(ExportLatestPropertiesFacilitiesTableSeeder::class);
    }
}
