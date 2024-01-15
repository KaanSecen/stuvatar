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
        $roll = number_format(mt_rand(0, 10000) / 100, 2);

        if ($roll <= 2.50 || $roll >= 97.50) {
            $rarity = 'legendary';
        } elseif ($roll <= 7.50 || $roll >= 92.50) {
            $rarity = 'rare';
        } elseif ($roll <= 15.00 || $roll >= 85.00) {
            $rarity = 'uncommon';
        } else {
            $rarity = 'common';
        }

        return [
            'chest_id' => $this->faker->numberBetween(1, 5),
            'item_id' => $this->faker->numberBetween(1, 200),
            'rarity' => $rarity,
        ];
    }
}
