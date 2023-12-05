<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // columns: username, name, password, email, chatword_id, status, type
            'username' => $this->faker->userName,
            'name' => $this->faker->name,
            'password' => bcrypt('password'),
            'email' => $this->faker->email,
            'chatword_id' => null,
            'status' => $this->faker->randomElement(['0', '1']),
            'type' => $this->faker->randomElement(['0', '1']),
        ];
    }
}
