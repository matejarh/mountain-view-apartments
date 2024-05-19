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
        (4, 1, 'home-page-hero', 'Home Page Hero', NULL, '2024-05-10 19:58:40', '2024-05-10 19:58:40'),
        (5, 1, 'nassfeld-and-lake-apartment', 'Nassfeld and Lake Apartment', NULL, '2024-05-10 20:28:26', '2024-05-10 20:28:26'),
        (6, 1, 'apartment-tree', 'Apartment Tree', NULL, '2024-05-18 19:47:20', '2024-05-18 19:47:20');
        INSERT INTO `images` (`id`, `user_id`, `slug`, `name`, `description`, `image_path`, `thumb_path`, `tile_path`, `likes_count`, `comments_count`, `created_at`, `updated_at`) VALUES
        (1, 1, 'nassfeld-oHkvf', 'Nassfeld', NULL, 'galleries-photos/test-admin/2aa4c8a07d1712c67958d314cd60d135c8dd64910a8d953d3fb7bcb2e6854f69.jpg', 'galleries-photos/test-admin/thumbs/2aa4c8a07d1712c67958d314cd60d135c8dd64910a8d953d3fb7bcb2e6854f69.jpg', 'galleries-photos/test-admin/tiles/2aa4c8a07d1712c67958d314cd60d135c8dd64910a8d953d3fb7bcb2e6854f69.jpg', 0, 0, '2024-05-06 03:49:12', '2024-05-18 18:47:29'),
        (2, 1, 'bled-IdLim', 'Bled', NULL, 'galleries-photos/test-admin/c228b92731ce059fd5e9ab67efe3bf802ca976b7f04b16686d6cecb99dd1dd68.jpg', 'galleries-photos/test-admin/thumbs/c228b92731ce059fd5e9ab67efe3bf802ca976b7f04b16686d6cecb99dd1dd68.jpg', 'galleries-photos/test-admin/tiles/c228b92731ce059fd5e9ab67efe3bf802ca976b7f04b16686d6cecb99dd1dd68.jpg', 0, 0, '2024-05-06 03:49:15', '2024-05-18 18:47:20'),
        (3, 1, 'winter-sunrise-WAcoi', 'Winter Sunrise', NULL, 'galleries-photos/test-admin/fa16b6cdc11a286a72adb55a99d33497dadc6ba0e58fba3e48c17a76b38a5034.jpg', 'galleries-photos/test-admin/thumbs/fa16b6cdc11a286a72adb55a99d33497dadc6ba0e58fba3e48c17a76b38a5034.jpg', 'galleries-photos/test-admin/tiles/fa16b6cdc11a286a72adb55a99d33497dadc6ba0e58fba3e48c17a76b38a5034.jpg', 0, 0, '2024-05-06 03:49:18', '2024-05-18 18:46:57'),
        (5, 1, 'bedroom-B2KJC', 'Bedroom', NULL, 'galleries-photos/test-admin/22b5f80ebe9108329b8d3203d0366352a14bb89e14e8b55830daee3bd925269c.jpg', 'galleries-photos/test-admin/thumbs/22b5f80ebe9108329b8d3203d0366352a14bb89e14e8b55830daee3bd925269c.jpg', 'galleries-photos/test-admin/tiles/22b5f80ebe9108329b8d3203d0366352a14bb89e14e8b55830daee3bd925269c.jpg', 0, 0, '2024-05-10 16:29:23', '2024-05-18 18:46:43'),
        (6, 1, 'bedroom-0zI41', 'Bedroom', NULL, 'galleries-photos/test-admin/353f3cf766bd8086b8808cccf4781059f0145c3141e9b6eae8d931c601e5d414.jpg', 'galleries-photos/test-admin/thumbs/353f3cf766bd8086b8808cccf4781059f0145c3141e9b6eae8d931c601e5d414.jpg', 'galleries-photos/test-admin/tiles/353f3cf766bd8086b8808cccf4781059f0145c3141e9b6eae8d931c601e5d414.jpg', 0, 0, '2024-05-10 16:29:33', '2024-05-18 18:46:33'),
        (7, 1, 'bedroom-s3vqX', 'Bedroom', NULL, 'galleries-photos/test-admin/bc86b645898e313271d451876427dca1c57531d866f89a29d83df1b6e4d7f20a.jpg', 'galleries-photos/test-admin/thumbs/bc86b645898e313271d451876427dca1c57531d866f89a29d83df1b6e4d7f20a.jpg', 'galleries-photos/test-admin/tiles/bc86b645898e313271d451876427dca1c57531d866f89a29d83df1b6e4d7f20a.jpg', 0, 0, '2024-05-10 16:29:37', '2024-05-18 18:46:22'),
        (8, 1, 'dining-corner-LJcwx', 'Dining corner', NULL, 'galleries-photos/test-admin/7485c7a8f78e2d3032e52142d8ba33e8e523d0dc68a33b8835808e95d24fd42b.jpg', 'galleries-photos/test-admin/thumbs/7485c7a8f78e2d3032e52142d8ba33e8e523d0dc68a33b8835808e95d24fd42b.jpg', 'galleries-photos/test-admin/tiles/7485c7a8f78e2d3032e52142d8ba33e8e523d0dc68a33b8835808e95d24fd42b.jpg', 0, 0, '2024-05-10 16:29:48', '2024-05-18 18:45:59'),
        (9, 1, 'bathroom-ddAoL', 'Bathroom', NULL, 'galleries-photos/test-admin/c6179c65cc1214885eacf4a39e4ed04adc0b645ab2b5e704bf78f506c59b1c69.jpg', 'galleries-photos/test-admin/thumbs/c6179c65cc1214885eacf4a39e4ed04adc0b645ab2b5e704bf78f506c59b1c69.jpg', 'galleries-photos/test-admin/tiles/c6179c65cc1214885eacf4a39e4ed04adc0b645ab2b5e704bf78f506c59b1c69.jpg', 0, 0, '2024-05-10 16:29:55', '2024-05-18 18:45:46'),
        (10, 1, 'patio-bdJkq', 'Patio', NULL, 'galleries-photos/test-admin/fa04ab0bf86bb44c5cac087bdf60d75971a860a1f6e0c2eb24cd6fa181c19322.jpg', 'galleries-photos/test-admin/thumbs/fa04ab0bf86bb44c5cac087bdf60d75971a860a1f6e0c2eb24cd6fa181c19322.jpg', 'galleries-photos/test-admin/tiles/fa04ab0bf86bb44c5cac087bdf60d75971a860a1f6e0c2eb24cd6fa181c19322.jpg', 0, 0, '2024-05-10 16:30:05', '2024-05-18 18:45:25'),
        (11, 1, 'view-pcTT2', 'View', NULL, 'galleries-photos/test-admin/eca8c06a425e633ac3efd5e672c92ce7970a335e9c8e166164020acb9650e587.jpg', 'galleries-photos/test-admin/thumbs/eca8c06a425e633ac3efd5e672c92ce7970a335e9c8e166164020acb9650e587.jpg', 'galleries-photos/test-admin/tiles/eca8c06a425e633ac3efd5e672c92ce7970a335e9c8e166164020acb9650e587.jpg', 0, 0, '2024-05-10 16:30:11', '2024-05-18 18:45:13'),
        (12, 1, 'lake-with-mountains-h2Znm', 'Lake with mountains', NULL, 'galleries-photos/test-admin/987c1e9c5d9e250d58a63fee127397a9cc0f654d7889963509e5ce11b61f4fc6.jpg', 'galleries-photos/test-admin/thumbs/987c1e9c5d9e250d58a63fee127397a9cc0f654d7889963509e5ce11b61f4fc6.jpg', 'galleries-photos/test-admin/tiles/987c1e9c5d9e250d58a63fee127397a9cc0f654d7889963509e5ce11b61f4fc6.jpg', 0, 0, '2024-05-10 16:30:25', '2024-05-18 18:44:52'),
        (13, 1, 'under-construction-MREBv', 'Under Construction', NULL, 'galleries-photos/test-admin/ee31d43e0a953f88f9527a6ed26a14ab7f80e36b359ff1a72e5cadc063f85cac.jpg', 'galleries-photos/test-admin/thumbs/ee31d43e0a953f88f9527a6ed26a14ab7f80e36b359ff1a72e5cadc063f85cac.jpg', 'galleries-photos/test-admin/tiles/ee31d43e0a953f88f9527a6ed26a14ab7f80e36b359ff1a72e5cadc063f85cac.jpg', 0, 0, '2024-05-14 20:30:28', '2024-05-18 18:44:15'),
        (14, 1, 'cycling-Wl6xi', 'Cycling', NULL, 'galleries-photos/test-admin/7a6a3ef77618592424670f1e997282ec0b7afcc122acd4fc3d190fa2699f3395.jpg', 'galleries-photos/test-admin/thumbs/7a6a3ef77618592424670f1e997282ec0b7afcc122acd4fc3d190fa2699f3395.jpg', 'galleries-photos/test-admin/tiles/7a6a3ef77618592424670f1e997282ec0b7afcc122acd4fc3d190fa2699f3395.jpg', 0, 0, '2024-05-15 02:39:20', '2024-05-18 18:43:40'),
        (15, 1, 'cow-w1XBf', 'Cow', NULL, 'galleries-photos/test-admin/7b8ed37f78706a6567e064a574809415baf2cb1f6bca166af4f26f4dc1123c47.jpg', 'galleries-photos/test-admin/thumbs/7b8ed37f78706a6567e064a574809415baf2cb1f6bca166af4f26f4dc1123c47.jpg', 'galleries-photos/test-admin/tiles/7b8ed37f78706a6567e064a574809415baf2cb1f6bca166af4f26f4dc1123c47.jpg', 0, 0, '2024-05-15 02:40:09', '2024-05-18 18:43:28'),
        (16, 1, 'peer-fgcwz', 'Peer', NULL, 'galleries-photos/test-admin/f619b9f168b54e01651cd58e4e4bf9026cfe9c1133c33698f13e776f02d6d7a8.jpg', 'galleries-photos/test-admin/thumbs/f619b9f168b54e01651cd58e4e4bf9026cfe9c1133c33698f13e776f02d6d7a8.jpg', 'galleries-photos/test-admin/tiles/f619b9f168b54e01651cd58e4e4bf9026cfe9c1133c33698f13e776f02d6d7a8.jpg', 0, 0, '2024-05-15 02:40:50', '2024-05-18 18:43:15'),
        (17, 1, 'field-XpiLq', 'Field', NULL, 'galleries-photos/test-admin/4bd9504d22594c7751ab87f40ef33822607818ddb768392e7b33dc330e2ab81b.jpg', 'galleries-photos/test-admin/thumbs/4bd9504d22594c7751ab87f40ef33822607818ddb768392e7b33dc330e2ab81b.jpg', 'galleries-photos/test-admin/tiles/4bd9504d22594c7751ab87f40ef33822607818ddb768392e7b33dc330e2ab81b.jpg', 0, 0, '2024-05-15 02:41:46', '2024-05-18 18:43:01'),
        (18, 1, 'lake-Cz0G6', 'lake', NULL, 'galleries-photos/test-admin/08823caa15e06cfe95c3ef8bf7f87d6635a942b30ac5f212a0928184775a6239.jpg', 'galleries-photos/test-admin/thumbs/08823caa15e06cfe95c3ef8bf7f87d6635a942b30ac5f212a0928184775a6239.jpg', 'galleries-photos/test-admin/tiles/08823caa15e06cfe95c3ef8bf7f87d6635a942b30ac5f212a0928184775a6239.jpg', 0, 0, '2024-05-15 02:43:57', '2024-05-18 18:42:31'),
        (19, 1, 'wc-QzsSQ', 'wc', NULL, 'galleries-photos/test-admin/f4f05690ae3f333d3c5a535a138d55176152b338d3a78aacca33c66982aadea4.jpg', 'galleries-photos/test-admin/thumbs/f4f05690ae3f333d3c5a535a138d55176152b338d3a78aacca33c66982aadea4.jpg', 'galleries-photos/test-admin/tiles/f4f05690ae3f333d3c5a535a138d55176152b338d3a78aacca33c66982aadea4.jpg', 0, 0, '2024-05-15 05:17:28', '2024-05-18 18:42:11');";


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
