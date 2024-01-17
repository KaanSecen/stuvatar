<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use AmplifiedHQ\Laravatar\Drivers\DiceBear;
use Illuminate\Support\Facades\Storage;

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


        $dicebear = new DiceBear($this->faker->uuid);

        $dicebear->setStyle('fun-emoji');

        $flip = $this->faker->boolean ? 'true' : 'false';

        $imageUrl = str_replace('size=96', 'size=1024', $dicebear->getUrl()) . '&backgroundRotation=' . $this->faker->numberBetween(1, 359). ',360&radius=50&rotate=' . $this->faker->numberBetween(0, 10). '&flip='. $flip .'&backgroundType=gradientLinear&backgroundColor='. str_replace('#', '', $this->faker->hexColor) .',' . str_replace('#', '', $this->faker->hexColor);

        $imageContent = file_get_contents($imageUrl);

        $imageName = 'item-'. $this->faker->uuid . '.svg';

        Storage::disk('public')->put('items/' . $imageName, $imageContent);

        return [
            'title' => $this->faker->word,
            'description' => $this->faker->sentence,
            'category_id' => $this->faker->numberBetween(1, 2),
            'background_color' => $this->faker->hexColor,
            'is_available_for_sale' => $this->faker->boolean,
            'price' => $this->faker->numberBetween(100, 500),
            'image' => 'items/' . $imageName,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
