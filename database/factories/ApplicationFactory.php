<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\ProjectRole;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Mendapatkan project_role_id secara acak
        $projectRoleId = $this->faker->numberBetween(1, 10);

        // Mengembalikan data form dengan project_id yang diperoleh
        return [
            "user_id" => 1,
            "project_role_id" => $projectRoleId,
            "cv_file" => $this->faker->word,
            "portofolio" => $this->faker->word,
        ];
    }
}
