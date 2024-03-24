<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Story;
use App\Models\Review;
use Faker\Factory as Faker;

class StorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create();
        // Create 50k stories
        foreach (range(1, 50000) as $index) {
            Story::create([
                'user_id' => User::inRandomOrder()->first()->id,
                'title' => $faker->sentence,
                'body' => $faker->paragraph,
            ]);
        }

    }
}

