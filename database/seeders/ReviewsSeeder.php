<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all()->skip(10)->take(10);

        $property = Property::find(1);

        $users->each(function ($user) use ($property) {
            Review::factory()->create([
                'user_id' => $user->id,
                'reviewed_id' => $property->id,
                'reviewed_type' => 'App\Models\Property',
            ]);
        });
    }
}
