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
            "company_id" => fake()->numberBetween(1, 10),
            "project_title" => fake()->sentence(2),
            "project_description" => fake()->sentence(10),
            "project_qualification" => fake()->sentence(10),
            "project_skill" => fake()->sentence(10),
            "job_type" => fake()->randomElement(["onsite", "offsite"]),
            "start_date" => fake()->date(),
            "end_date" => fake()->date(),
            "status" => "open",
        ];
    }
}
