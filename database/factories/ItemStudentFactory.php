<?php

namespace Database\Factories;

use App\Models\ItemStudent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ItemStudent>
 */
class ItemStudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = ItemStudent::class;

    public function definition(): array
    {
        return [
            'student_id' => $this->faker->numberBetween(1, 100),
            'item_id' => $this->faker->numberBetween(1, 100),
            'is_active' => $this->faker->boolean,
        ];
    }
}
