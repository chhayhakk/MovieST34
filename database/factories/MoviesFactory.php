<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use App\Models\Movies;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MoviesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Movies::class;
    public function definition(): array
    {
        return [
            'title' => 'Duty After School',
            'description' => $this->faker->paragraph,
            'duration' => '2:22:22', // You can use faker as well for dynamic duration
            'year' => 2022,
            'image_path' => 'dutyafterschool.jpg', // You can use faker for dynamic image paths
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'release' => 2022,
            'quality' => '4k',
            'type' => 'tvshow',
            'back_photo' => 'dutyafterschoolback.jpeg', // Faker can generate back photos dynamically as well
            'user_id' => 1, // Assuming you have a user with ID 1
            'genre_id' => 1, // Assuming genre is a foreign key relationship
        ];
    }
}
