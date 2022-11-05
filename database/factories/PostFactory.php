<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Category;
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
            'user_id' => User::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'image' => 'https://placeimg.com/640/480/any',
            'color' => $this->faker->colorName,
            'brand' => $this->faker->company,
            'description' => $this->faker->paragraph(2),
            'datetime' => $this->faker->dateTime,
            'reward' => $this->faker->randomFloat(2, 0, 10000),
            'is_lost' => $this->faker->boolean,
            'is_done' => $this->faker->boolean,
            'latitude' => $this->faker->latitude(13.83, 13.9),
            'longitude' => $this->faker->longitude(100.5, 100.6),
        ];
    }
}
