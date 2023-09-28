<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Grade>
 */
class GradeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $student = DB::table('students')->inRandomOrder()->first();
        return [
            'student_id' => $student->id,
            'subject' => fake()->numberBetween(1, 3),
            'grade' => fake()->numberBetween(0, 10),
        ];
    }
}
