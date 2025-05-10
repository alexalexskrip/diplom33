<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProjectNews>
 */
class ProjectNewsFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id_project' => Project::query()->inRandomOrder()->first()?->id ?? Project::factory(),
//            'date_projectnews' => $this->faker->date(),
            'name_projectnews' => $this->faker->sentence(4),
            'discription_projectnews' => $this->faker->paragraph(),
        ];
    }
}
