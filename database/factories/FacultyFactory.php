<?php

namespace Database\Factories;

use App\Models\Faculty;
use App\Models\University;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Faculty>
 */
class FacultyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_university' => University::query()->inRandomOrder()->value('id') ?? University::factory(),
            'name_faculty' => $this->faker->words(2, true),
        ];
    }
}
