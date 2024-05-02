<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GalleriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Gallery::truncate();

        $galleries = [
            [
                'user_id' => 2,
                'name' => 'Test Gallery 1',
                'slug' => 'test-gallery-1',
                'description' => fake()->sentence(),
            ],
            [
                'user_id' => 2,
                'name' => 'Test Gallery 2',
                'slug' => 'test-gallery-2',
                'description' => fake()->sentence(),
            ],
            [
                'user_id' => 2,
                'name' => 'Test Gallery 3',
                'slug' => 'test-gallery-3',
                'description' => fake()->sentence(),
            ],
        ];

        foreach ($galleries as $key => $gallery) {
            # code...
            Gallery::factory($gallery)->create();
        }

        $images = [
            [
                'user_id' => 2,
                'name' => 'Test Image 1',
                'slug' => 'test-image-1',
                'description' => fake()->sentence(),
                'image_path' => fake()->imageUrl(),
            ],
            [
                'user_id' => 2,
                'name' => 'Test Image 2',
                'slug' => 'test-image-2',
                'description' => fake()->sentence(),
                'image_path' => fake()->imageUrl(),
            ],
            [
                'user_id' => 2,
                'name' => 'Test Image 3',
                'slug' => 'test-image-3',
                'description' => fake()->sentence(),
                'image_path' => fake()->imageUrl(),
            ],
        ];

        foreach ($images as $key => $image) {
            Image::factory($image)->create();
        }

        $galleries = Gallery::latest();
        $images = Image::latest();

        $images->each(function($image) use ($galleries) {
            $galleries->each(function($gallery) use ($image) {
                $gallery->images()->attach($image);
            });
        });

    }
}
