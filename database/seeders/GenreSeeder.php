<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genres;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $n = 1;
        while($n < 10)
        {
            $faker = \Faker\Factory::create();
            $faker->addProvider(new \Xylis\FakerCinema\Provider\Movie($faker));

            Genres::create([
                'name' => $faker->movieGenre,
            ]);
            $n++;
        }
    }
}
