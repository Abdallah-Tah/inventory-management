<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'image' => $this->faker->image(public_path() . '/images/', 640, 480, null, false),
            'price' => $this->faker->randomFloat(2, 0, 100),
            'stock' => $this->faker->randomNumber(1),
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}
