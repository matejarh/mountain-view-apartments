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

        $sql = "INSERT INTO `galleries` (`id`, `user_id`, `slug`, `name`, `description`, `created_at`, `updated_at`) VALUES
        (1, 1, 'test-gallery-1', 'Test Gallery 1', 'Illum nesciunt voluptatem est pariatur unde optio voluptas aut.', '2024-05-10 21:20:48', '2024-05-10 21:20:48'),
        (2, 1, 'test-gallery-2', 'Test Gallery 2', 'Et aut quas aut qui et dolores et.', '2024-05-10 21:20:48', '2024-05-10 21:20:48'),
        (3, 1, 'test-gallery-3', 'Test Gallery 3', 'Voluptatem velit ullam labore nihil id voluptatibus.', '2024-05-10 21:20:48', '2024-05-10 21:20:48'),
        (4, 1, 'home-page-hero', 'Home Page Hero', NULL, '2024-05-10 21:58:40', '2024-05-10 21:58:40'),
        (5, 1, 'nassfeld-and-lake-apartment', 'Nassfeld and Lake Apartment', NULL, '2024-05-10 22:28:26', '2024-05-10 22:28:26');
        INSERT INTO `images` (`id`, `user_id`, `slug`, `name`, `description`, `image_path`, `thumb_path`, `created_at`, `updated_at`) VALUES
        (1, 1, 'nassfeld', 'Nassfeld', '', 'galleries-photos/test-admin/7869a422e4ee6b40d436802258fe32f71c593c415b7d1e19023a9376d3e0ad1f.jpg', 'galleries-photos/test-admin/thumbs/7869a422e4ee6b40d436802258fe32f71c593c415b7d1e19023a9376d3e0ad1f.jpg', '2024-05-06 09:49:12', '2024-05-06 09:49:13'),
        (2, 1, 'bled', 'Bled', '', 'galleries-photos/test-admin/991d665201f1b0265386cc54b2aeb1e00cf3857521659c6683a005be8acde105.jpg', 'galleries-photos/test-admin/thumbs/991d665201f1b0265386cc54b2aeb1e00cf3857521659c6683a005be8acde105.jpg', '2024-05-06 09:49:15', '2024-05-06 09:49:15'),
        (3, 1, 'winter-sunrise', 'Winter Sunrise', '', 'galleries-photos/test-admin/32af93f3987513d62f85bd2c3f87ada668f39f28b5fce4e7386f1eb3b11b5555.jpg', 'galleries-photos/test-admin/thumbs/32af93f3987513d62f85bd2c3f87ada668f39f28b5fce4e7386f1eb3b11b5555.jpg', '2024-05-06 09:49:18', '2024-05-06 09:49:19'),
        (5, 1, 'bedroom', 'Bedroom', '', 'galleries-photos/test-admin/6fc1cba52ab6e9e9d57dea7a52b3772e13de5150c4cc43ae4cdccb7addfc3948.jpg', 'galleries-photos/test-admin/thumbs/6fc1cba52ab6e9e9d57dea7a52b3772e13de5150c4cc43ae4cdccb7addfc3948.jpg', '2024-05-10 22:29:23', '2024-05-10 22:29:23'),
        (6, 1, 'bedroom', 'Bedroom', '', 'galleries-photos/test-admin/d234f60418d2333f1af443967a26b10a59fdf91d3ae83d979dcc8621e037f6ff.jpg', 'galleries-photos/test-admin/thumbs/d234f60418d2333f1af443967a26b10a59fdf91d3ae83d979dcc8621e037f6ff.jpg', '2024-05-10 22:29:33', '2024-05-10 22:29:33'),
        (7, 1, 'beddroom', 'Beddroom', '', 'galleries-photos/test-admin/022aac956d12601211ccf2f2c4ca9f83fe3808d1e5560089f4d5cb7c90fa6ad5.jpg', 'galleries-photos/test-admin/thumbs/022aac956d12601211ccf2f2c4ca9f83fe3808d1e5560089f4d5cb7c90fa6ad5.jpg', '2024-05-10 22:29:37', '2024-05-10 22:29:37'),
        (8, 1, 'dining-corner', 'Dining corner', '', 'galleries-photos/test-admin/e09b2f492e4dd6b8a1d50f414c914bae6903fb20165f1c3fd437b27f2344303f.jpg', 'galleries-photos/test-admin/thumbs/e09b2f492e4dd6b8a1d50f414c914bae6903fb20165f1c3fd437b27f2344303f.jpg', '2024-05-10 22:29:48', '2024-05-10 22:29:49'),
        (9, 1, 'bathroom', 'Bathroom', '', 'galleries-photos/test-admin/7af0fa16e1d15d148fb6c0b6ea4e5c4bf2ce0d04d1b3775ec6ebec013d8ace99.jpg', 'galleries-photos/test-admin/thumbs/7af0fa16e1d15d148fb6c0b6ea4e5c4bf2ce0d04d1b3775ec6ebec013d8ace99.jpg', '2024-05-10 22:29:55', '2024-05-10 22:29:56'),
        (10, 1, 'patio', 'Patio', '', 'galleries-photos/test-admin/146ccec1927d076c536e11b1e43b38c12cebcec7de8dcbadd41ad8a189733c41.jpg', 'galleries-photos/test-admin/thumbs/146ccec1927d076c536e11b1e43b38c12cebcec7de8dcbadd41ad8a189733c41.jpg', '2024-05-10 22:30:05', '2024-05-10 22:30:05'),
        (11, 1, 'view', 'View', '', 'galleries-photos/test-admin/77f2991b0cf3c1f9ae3363b5ddcb99266db0496cbf2db550903fbb309ebf55e4.jpg', 'galleries-photos/test-admin/thumbs/77f2991b0cf3c1f9ae3363b5ddcb99266db0496cbf2db550903fbb309ebf55e4.jpg', '2024-05-10 22:30:11', '2024-05-10 22:30:11'),
        (12, 1, 'lake-with-mountains', 'Lake with mountains', '', 'galleries-photos/test-admin/987e2d07949c0ef98daaeb20018d0577a6465f96f5210d92c21f831f250681c8.jpg', 'galleries-photos/test-admin/thumbs/987e2d07949c0ef98daaeb20018d0577a6465f96f5210d92c21f831f250681c8.jpg', '2024-05-10 22:30:25', '2024-05-10 22:30:25');";

        \DB::unprepared($sql);

        $sql="INSERT INTO `galleries_images` (`id`, `gallery_id`, `image_id`,`order`, `created_at`, `updated_at`) VALUES
        (4, 1, 3, 1, NULL, NULL),
        (5, 2, 3, 1, NULL, NULL),
        (6, 3, 3, 1, NULL, NULL),
        (7, 1, 2, 2, NULL, NULL),
        (8, 2, 2, 2, NULL, NULL),
        (9, 3, 2, 2, NULL, NULL),
        (10, 1, 1, 3, NULL, NULL),
        (11, 2, 1, 3, NULL, NULL),
        (12, 3, 1, 3, NULL, NULL),
        (13, 4, 2, 1, NULL, NULL),
        (14, 4, 1, 2, NULL, NULL),
        (15, 4, 3, 3, NULL, NULL),
        (16, 5, 12, 1, NULL, NULL),
        (17, 5, 11, 2, NULL, NULL),
        (18, 5, 10, 3, NULL, NULL),
        (19, 5, 9, 4, NULL, NULL),
        (20, 5, 8, 5, NULL, NULL),
        (21, 5, 7, 6, NULL, NULL),
        (22, 5, 5, 7,NULL, NULL);
        INSERT INTO `pages_galleries` (`id`, `gallery_id`, `page_id`, `created_at`, `updated_at`) VALUES
        (1, 4, 1, NULL, NULL);
        INSERT INTO `properties_galleries` (`id`, `property_id`, `gallery_id`, `created_at`, `updated_at`) VALUES
        (1, 1, 5, NULL, NULL);";

        \DB::unprepared($sql);


/*         $galleries = Gallery::latest();
        $images = Image::latest();

        $images->each(function ($image) use ($galleries) {
            $galleries->each(function ($gallery) use ($image) {
                $gallery->images()->attach($image);
            });
        }); */

    }
}
