<?php

namespace Database\Factories;

use AmplifiedHQ\Laravatar\Drivers\DiceBear;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

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
        $dicebear = new DiceBear($this->faker->uuid);

        $dicebear->setStyle('icons');

        $imageUrl = str_replace('size=96', 'size=1024', $dicebear->getUrl()) . '&backgroundRotation=' . $this->faker->numberBetween(1, 359). ',360&icon=gift&radius=50&backgroundType=gradientLinear&backgroundColor='. str_replace('#', '', $this->faker->hexColor) .',' . str_replace('#', '', $this->faker->hexColor);

        $imageContent = file_get_contents($imageUrl);

        $imageName = 'chest-'. $this->faker->uuid . '.svg';

        Storage::disk('public')->put('chests/' . $imageName, $imageContent);

        return [
            'title' => $this->faker->word,
            'description' => $this->faker->sentence,
            'is_available_for_sale' => $this->faker->boolean,
            'price' => $this->faker->numberBetween(150, 1000),
            'image' => 'chests/' . $imageName,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
