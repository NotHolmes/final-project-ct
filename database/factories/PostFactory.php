<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'image' => $this->faker->imageUrl,
            'description' => $this->faker->paragraph(3),
            'published_at' => $this->faker->dateTime,
            'reward' => $this->faker->randomFloat(2, 0, 10000),
            'is_lost' => $this->faker->boolean,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ];
    }
}
