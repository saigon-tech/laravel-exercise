<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // columns: name, description, status, start, end
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'start' => $this->faker->dateTime,
            'end' => $this->faker->dateTime,
            'status' => $this->faker->randomElement(['0', '1', '2']),
        ];
    }
}
