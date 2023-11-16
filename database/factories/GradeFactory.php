<?php


namespace Database\Factories;

use App\Models\Grade;
use Illuminate\Database\Eloquent\Factories\Factory;

class GradeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Grade::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gradeNumber = $this->faker->numberBetween(1, 8);
        $gradeTitle = 'Groep ' . $gradeNumber . $this->faker->randomElement(range('A', 'Z'));
        return [
            'title' => $gradeTitle,
            'description' => $this->faker->sentence,
            'color' => $this->faker->hexColor,
            'grade_number' => $gradeNumber,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

