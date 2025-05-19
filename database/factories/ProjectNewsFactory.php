<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\ProjectNews;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProjectNews>
 */
class ProjectNewsFactory extends Factory
{
    public function definition(): array
    {
        return [
            'project_id' => Project::query()->inRandomOrder()->first()?->id ?? Project::factory(),
            'name' => $this->faker->sentence(4),
            'description' => $this->faker->text(255),
        ];
    }
}
