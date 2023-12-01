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
        $image = 'items/' . $this->faker->image(storage_path('app/public/items'), 512, 512, 'animals',false, true, 'cats');
        return [
            'title' => $this->faker->word,
            'description' => $this->faker->sentence,
            'category_id' => $this->faker->numberBetween(1, 20),
            'background_color' => $this->faker->hexColor,
            'image' => $image,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
