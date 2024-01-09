<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ItemChest>
 */
class ItemChestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'chest_id' => $this->faker->numberBetween(1, 5),
            'item_id' => $this->faker->numberBetween(1, 200),
            'rarity' => $this->faker->randomElement(['common', 'uncommon', 'rare', 'legendary']),
        ];
    }
}
