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
        //\Illuminate\Database\Model::unguard();

        $galleries = [
            [
                'user_id' => 1,
                'name' => 'Test Gallery 1',
                'slug' => 'test-gallery-1',
                'description' => fake()->sentence(),
            ],
            [
                'user_id' => 1,
                'name' => 'Test Gallery 2',
                'slug' => 'test-gallery-2',
                'description' => fake()->sentence(),
            ],
            [
                'user_id' => 1,
                'name' => 'Test Gallery 3',
                'slug' => 'test-gallery-3',
                'description' => fake()->sentence(),
            ],
        ];


        foreach ($galleries as $key => $gallery) {
            Gallery::factory($gallery)->create();
        }

        $sql="INSERT INTO `images` (`id`, `user_id`, `slug`, `name`, `description`, `image_path`, `thumb_path`, `created_at`, `updated_at`) VALUES
        (1, 1, 'nassfeld', 'Nassfeld', '', 'galleries-photos/test-admin/7869a422e4ee6b40d436802258fe32f71c593c415b7d1e19023a9376d3e0ad1f.jpg', 'galleries-photos/test-admin/thumbs/7869a422e4ee6b40d436802258fe32f71c593c415b7d1e19023a9376d3e0ad1f.jpg', '2024-05-06 11:49:12', '2024-05-06 11:49:13'),
        (2, 1, 'bled', 'Bled', '', 'galleries-photos/test-admin/991d665201f1b0265386cc54b2aeb1e00cf3857521659c6683a005be8acde105.jpg', 'galleries-photos/test-admin/thumbs/991d665201f1b0265386cc54b2aeb1e00cf3857521659c6683a005be8acde105.jpg', '2024-05-06 11:49:15', '2024-05-06 11:49:15'),
        (3, 1, 'winter-sunrise', 'Winter Sunrise', '', 'galleries-photos/test-admin/32af93f3987513d62f85bd2c3f87ada668f39f28b5fce4e7386f1eb3b11b5555.jpg', 'galleries-photos/test-admin/thumbs/32af93f3987513d62f85bd2c3f87ada668f39f28b5fce4e7386f1eb3b11b5555.jpg', '2024-05-06 11:49:18', '2024-05-06 11:49:19'),
        (4, 1, 'bed', 'Bed', '', 'galleries-photos/test-admin/4b51a032e5572acbd4b5ed19211adf81fdf30f167bcfcb41ec57afc1017a1a06.jpg', 'galleries-photos/test-admin/thumbs/4b51a032e5572acbd4b5ed19211adf81fdf30f167bcfcb41ec57afc1017a1a06.jpg', '2024-05-06 21:36:36', '2024-05-06 21:36:37');";

        \DB::unprepared($sql);

        $galleries = Gallery::latest();
        $images = Image::latest();

        $images->each(function($image) use ($galleries) {
            $galleries->each(function($gallery) use ($image) {
                $gallery->images()->attach($image);
            });
        });

    }
}
