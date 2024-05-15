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
        INSERT INTO `images` (`id`, `user_id`, `slug`, `name`, `description`, `image_path`, `thumb_path`, `tile_path`, `created_at`, `updated_at`) VALUES
        (1, 1, 'nassfeld-9iCW3', 'Nassfeld', '', 'galleries-photos/test-admin/4af1fb1a278b345e26ceb06aaff8f3008559bf9f9d110fbc1241e54bcfce6c06.jpg', 'galleries-photos/test-admin/thumbs/4af1fb1a278b345e26ceb06aaff8f3008559bf9f9d110fbc1241e54bcfce6c06.jpg', 'galleries-photos/test-admin/tiles/4af1fb1a278b345e26ceb06aaff8f3008559bf9f9d110fbc1241e54bcfce6c06.jpg', '2024-05-06 05:49:12', '2024-05-14 17:57:29'),
        (2, 1, 'bled-BS31f', 'Bled', '', 'galleries-photos/test-admin/989ce257afae3e0fa57a6758d64abd10e9652f070a102b4d075b4ef434322dc3.jpg', 'galleries-photos/test-admin/thumbs/989ce257afae3e0fa57a6758d64abd10e9652f070a102b4d075b4ef434322dc3.jpg', 'galleries-photos/test-admin/tiles/989ce257afae3e0fa57a6758d64abd10e9652f070a102b4d075b4ef434322dc3.jpg', '2024-05-06 05:49:15', '2024-05-14 17:57:08'),
        (3, 1, 'winter-sunrise-8fo9g', 'Winter Sunrise', '', 'galleries-photos/test-admin/35c1d23d6de66417723a8f3beb58e5800a87684a9b0435ae1b0034e088d0f2da.jpg', 'galleries-photos/test-admin/thumbs/35c1d23d6de66417723a8f3beb58e5800a87684a9b0435ae1b0034e088d0f2da.jpg', 'galleries-photos/test-admin/tiles/35c1d23d6de66417723a8f3beb58e5800a87684a9b0435ae1b0034e088d0f2da.jpg', '2024-05-06 05:49:18', '2024-05-14 17:56:43'),
        (5, 1, 'bedroom-pxHNw', 'Bedroom', '', 'galleries-photos/test-admin/ee219ccaf236c039063420f3df6089cdf60e84191ef2a1ca27667cdcb45db7ca.jpg', 'galleries-photos/test-admin/thumbs/ee219ccaf236c039063420f3df6089cdf60e84191ef2a1ca27667cdcb45db7ca.jpg', 'galleries-photos/test-admin/tiles/ee219ccaf236c039063420f3df6089cdf60e84191ef2a1ca27667cdcb45db7ca.jpg', '2024-05-10 18:29:23', '2024-05-14 17:46:43'),
        (6, 1, 'bedroom-Gfk65', 'Bedroom', '', 'galleries-photos/test-admin/46c33c5c316a580ce2d7d51705d4bbf239138e6e9383e1b0b9fa2e3347b26c04.jpg', 'galleries-photos/test-admin/thumbs/46c33c5c316a580ce2d7d51705d4bbf239138e6e9383e1b0b9fa2e3347b26c04.jpg', 'galleries-photos/test-admin/tiles/46c33c5c316a580ce2d7d51705d4bbf239138e6e9383e1b0b9fa2e3347b26c04.jpg', '2024-05-10 18:29:33', '2024-05-14 17:47:00'),
        (7, 1, 'beddroom-oRGAn', 'Beddroom', '', 'galleries-photos/test-admin/c55e0869589e35c39cde95c7061bb969dff885a197936db1b8151ab5e6e40a16.jpg', 'galleries-photos/test-admin/thumbs/c55e0869589e35c39cde95c7061bb969dff885a197936db1b8151ab5e6e40a16.jpg', 'galleries-photos/test-admin/tiles/c55e0869589e35c39cde95c7061bb969dff885a197936db1b8151ab5e6e40a16.jpg', '2024-05-10 18:29:37', '2024-05-14 17:46:33'),
        (8, 1, 'dining-corner-Rq5LP', 'Dining corner', '', 'galleries-photos/test-admin/c5768357958a271bd0fa6caae7a1d64cf79973b0aa9baa2cf17bc4e485368888.jpg', 'galleries-photos/test-admin/thumbs/c5768357958a271bd0fa6caae7a1d64cf79973b0aa9baa2cf17bc4e485368888.jpg', 'galleries-photos/test-admin/tiles/c5768357958a271bd0fa6caae7a1d64cf79973b0aa9baa2cf17bc4e485368888.jpg', '2024-05-10 18:29:48', '2024-05-14 17:46:19'),
        (9, 1, 'bathroom-ECWoj', 'Bathroom', '', 'galleries-photos/test-admin/3bd735ae4155ec01ff2bd8abe5bd1acd7ced14002037e60fa03e6009c4be5f59.jpg', 'galleries-photos/test-admin/thumbs/3bd735ae4155ec01ff2bd8abe5bd1acd7ced14002037e60fa03e6009c4be5f59.jpg', 'galleries-photos/test-admin/tiles/3bd735ae4155ec01ff2bd8abe5bd1acd7ced14002037e60fa03e6009c4be5f59.jpg', '2024-05-10 18:29:55', '2024-05-14 17:46:08'),
        (10, 1, 'patio-GMS8f', 'Patio', '', 'galleries-photos/test-admin/7a9ed0938e3c38413a49c5483053c7384c7807a2ebde92a04bcff140b89def33.jpg', 'galleries-photos/test-admin/thumbs/7a9ed0938e3c38413a49c5483053c7384c7807a2ebde92a04bcff140b89def33.jpg', 'galleries-photos/test-admin/tiles/7a9ed0938e3c38413a49c5483053c7384c7807a2ebde92a04bcff140b89def33.jpg', '2024-05-10 18:30:05', '2024-05-14 17:44:28'),
        (11, 1, 'view-LS9nn', 'View', '', 'galleries-photos/test-admin/7fc525d57259b20fe30c84de0b1689aecd72086d6623bc36858e8d98661f640d.jpg', 'galleries-photos/test-admin/thumbs/7fc525d57259b20fe30c84de0b1689aecd72086d6623bc36858e8d98661f640d.jpg', 'galleries-photos/test-admin/tiles/7fc525d57259b20fe30c84de0b1689aecd72086d6623bc36858e8d98661f640d.jpg', '2024-05-10 18:30:11', '2024-05-14 17:44:15'),
        (12, 1, 'lake-with-mountains-ReVf1', 'Lake with mountains', '', 'galleries-photos/test-admin/aa100f3a29944a1f24c57cad2f16303ff46fc86f461fec73082ec8e8dbdbe828.jpg', 'galleries-photos/test-admin/thumbs/aa100f3a29944a1f24c57cad2f16303ff46fc86f461fec73082ec8e8dbdbe828.jpg', 'galleries-photos/test-admin/tiles/aa100f3a29944a1f24c57cad2f16303ff46fc86f461fec73082ec8e8dbdbe828.jpg', '2024-05-10 18:30:25', '2024-05-14 17:43:57'),
        (13, 1, 'under-construction-t5CE0', 'Under Construction', '', 'galleries-photos/test-admin/6044d3a7af7166e758b0c3be0e7c96883f9a01b20fff0b9fdcd237b076153732.jpg', 'galleries-photos/test-admin/thumbs/6044d3a7af7166e758b0c3be0e7c96883f9a01b20fff0b9fdcd237b076153732.jpg', 'galleries-photos/test-admin/tiles/6044d3a7af7166e758b0c3be0e7c96883f9a01b20fff0b9fdcd237b076153732.jpg', '2024-05-14 22:30:28', '2024-05-14 22:30:29'),
        (14, 1, 'cycling-zOK1g', 'Cycling', '', 'galleries-photos/test-admin/e3e7ff440652bec56412e01ebeece27d0cbec3a84ecbd858f22a321d449eeb1f.jpg', 'galleries-photos/test-admin/thumbs/e3e7ff440652bec56412e01ebeece27d0cbec3a84ecbd858f22a321d449eeb1f.jpg', 'galleries-photos/test-admin/tiles/e3e7ff440652bec56412e01ebeece27d0cbec3a84ecbd858f22a321d449eeb1f.jpg', '2024-05-15 04:39:20', '2024-05-15 04:39:21'),
        (15, 1, 'cow-zjAtR', 'Cow', '', 'galleries-photos/test-admin/9df990ea046d1bd528e4b921d143a05c2418db6669ec3f85bf0519d381e2e387.jpg', 'galleries-photos/test-admin/thumbs/9df990ea046d1bd528e4b921d143a05c2418db6669ec3f85bf0519d381e2e387.jpg', 'galleries-photos/test-admin/tiles/9df990ea046d1bd528e4b921d143a05c2418db6669ec3f85bf0519d381e2e387.jpg', '2024-05-15 04:40:09', '2024-05-15 04:40:10'),
        (16, 1, 'peer-RF2rH', 'Peer', '', 'galleries-photos/test-admin/2219b72e3b3097d5635ee87766b5c9c9c9792dcbb24a860655ea8562be362194.jpg', 'galleries-photos/test-admin/thumbs/2219b72e3b3097d5635ee87766b5c9c9c9792dcbb24a860655ea8562be362194.jpg', 'galleries-photos/test-admin/tiles/2219b72e3b3097d5635ee87766b5c9c9c9792dcbb24a860655ea8562be362194.jpg', '2024-05-15 04:40:50', '2024-05-15 04:40:51'),
        (17, 1, 'field-V7Wuo', 'Field', '', 'galleries-photos/test-admin/4bbbe2bed440a8e690a0d98f056e4dc4bda7b4060fab82818b0254884700cf61.jpg', 'galleries-photos/test-admin/thumbs/4bbbe2bed440a8e690a0d98f056e4dc4bda7b4060fab82818b0254884700cf61.jpg', 'galleries-photos/test-admin/tiles/4bbbe2bed440a8e690a0d98f056e4dc4bda7b4060fab82818b0254884700cf61.jpg', '2024-05-15 04:41:46', '2024-05-15 04:41:46'),
        (18, 1, 'lake-BvE7Z', 'lake', '', 'galleries-photos/test-admin/cdaa3f7701cce9abee2aa2109eda654c1d49558d8b4e2729df69d11f5e52f2d2.jpg', 'galleries-photos/test-admin/thumbs/cdaa3f7701cce9abee2aa2109eda654c1d49558d8b4e2729df69d11f5e52f2d2.jpg', 'galleries-photos/test-admin/tiles/cdaa3f7701cce9abee2aa2109eda654c1d49558d8b4e2729df69d11f5e52f2d2.jpg', '2024-05-15 04:43:57', '2024-05-15 04:43:58'),
        (19, 1, 'wc-cGis9', 'wc', NULL, 'galleries-photos/test-admin/89c74f68814e8d3b858c8455c8f90397f7fa9240dfc556724324d15d2894340a.jpg', 'galleries-photos/test-admin/thumbs/89c74f68814e8d3b858c8455c8f90397f7fa9240dfc556724324d15d2894340a.jpg', 'galleries-photos/test-admin/tiles/89c74f68814e8d3b858c8455c8f90397f7fa9240dfc556724324d15d2894340a.jpg', '2024-05-15 07:17:28', '2024-05-15 07:17:28');";


        \DB::unprepared($sql);

        $sql = "INSERT INTO `galleries_images` (`id`, `gallery_id`, `image_id`, `order`, `created_at`, `updated_at`) VALUES
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
        (16, 5, 12, 1, NULL, '2024-05-15 06:30:18'),
        (17, 5, 11, 7, NULL, '2024-05-15 07:24:42'),
        (18, 5, 10, 9, NULL, '2024-05-15 07:21:58'),
        (19, 5, 9, 11, NULL, '2024-05-15 07:21:58'),
        (20, 5, 8, 14, NULL, '2024-05-15 07:21:58'),
        (21, 5, 7, 10, NULL, '2024-05-15 07:21:58'),
        (22, 5, 5, 2, NULL, '2024-05-15 07:21:58'),
        (23, 5, 6, 5, '2024-05-14 18:02:33', '2024-05-15 07:24:46'),
        (24, 5, 14, 13, '2024-05-15 04:39:28', '2024-05-15 07:21:58'),
        (25, 5, 15, 4, '2024-05-15 04:40:15', '2024-05-15 07:21:58'),
        (26, 5, 16, 8, '2024-05-15 04:40:55', '2024-05-15 07:21:58'),
        (27, 5, 17, 6, '2024-05-15 04:41:51', '2024-05-15 07:24:46'),
        (28, 5, 18, 3, '2024-05-15 04:44:03', '2024-05-15 07:21:58'),
        (29, 5, 19, 12, '2024-05-15 07:17:37', '2024-05-15 07:21:58'),
        (30, 5, 13, 15, '2024-05-15 07:24:57', '2024-05-15 07:24:57');
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
