<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Story;
use App\Models\Review;
use Faker\Factory as Faker;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
        public function run(): void
        {

            $faker = Faker::create();

            // Create more than 20k reviews
            foreach (range(1, 20000) as $index) {
                Review::create([
                    'user_id' => User::inRandomOrder()->first()->id,
                    'story_id' => Story::inRandomOrder()->first()->id,
                    'rating' => $faker->numberBetween(1, 5),
                    'comment' => $faker->sentence,
                ]);
        }
    }
}
