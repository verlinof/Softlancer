<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProjectRole>
 */
class ProjectRoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "project_id" => fake()->numberBetween(1, 10),
            "role_id" => fake()->numberBetween(1, 10),
            "accepted_person" => 0,
            "max_person" => fake()->numberBetween(1, 20),
        ];
    }
}
