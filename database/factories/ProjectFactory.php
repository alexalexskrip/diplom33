<?php

namespace Database\Factories;

use App\Models\StatusList;
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
            'id_status' => StatusList::query()->inRandomOrder()->value('id') ?? StatusList::factory(),
            'name_project' => $this->faker->sentence(3),
            'discription_project' => $this->faker->text(255),
        ];
    }
}
