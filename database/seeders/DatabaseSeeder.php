<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Movies;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Movies::factory()->create([
        'title' => 'Duty After School',
        'description' => 'This is a Tv Show',
        'duration' => '2:22:22',
        'year' => '2022',
        'image_path' => 'dutyafterschool.jpg',
        'created_at' => Carbon::now(),
        'updated_at'=>Carbon::now(),
        'release' => '2022',
        'quality' => '4k',
        'type' => 'tvshow',
        'back_photo' => 'dutyafterschoolback.jpeg',
        'user_id'=>'1',
        'genre_id' =>'2',
        ]);
    }

}
