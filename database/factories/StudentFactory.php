<?php

namespace Database\Factories;

use App\Models\Grade;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'grade_id' => $this->faker->numberBetween(1, 10),
            'card' => $this->faker->regexify('[A-Za-z0-9]{9}'),
            'points' => $this->faker->numberBetween(100, 200),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

