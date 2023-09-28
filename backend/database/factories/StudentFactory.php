<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->name();
        $name = substr($name, 0, 20);
        return [
            'name' => $name,
            'birthday' => fake()->dateTimeBetween('01/01/1990', '01/01/2015')->format('Y-m-d')
        ];
    }
}
