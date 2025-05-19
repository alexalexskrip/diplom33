<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Project>
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
            'status_id' => Status::query()->inRandomOrder()->value('id') ?? Status::factory(),
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->text(255),
        ];
    }
}
