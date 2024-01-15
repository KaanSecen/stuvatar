<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chest>
 */
class ChestFactory extends Factory
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

        $image = 'chests/' . $faker->gravatar(storage_path('app/public/chests'), 'retro', null, 512, false);
        return [
            'title' => $this->faker->word,
            'description' => $this->faker->sentence,
            'is_available_for_sale' => $this->faker->boolean,
            'price' => $this->faker->numberBetween(150, 1000),
            'image' => $image,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
