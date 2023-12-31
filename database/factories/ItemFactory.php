<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Ottaviano\Faker\Gravatar($faker));

        $image = 'items/' . $faker->gravatar(storage_path('app/public/items'), 'robohash', null, 512, false);
        return [
            'title' => $this->faker->word,
            'description' => $this->faker->sentence,
            'category_id' => $this->faker->numberBetween(1, 10),
            'background_color' => $this->faker->hexColor,
            'is_available_for_sale' => $this->faker->boolean,
            'price' => $this->faker->numberBetween(100, 500),
            'image' => $image,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
