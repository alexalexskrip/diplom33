<?php

namespace Database\Factories;

use App\Models\Faculty;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'faculty_id' => Faculty::inRandomOrder()->value('id') ?? Faculty::factory(),
            'name' => $this->faker->words(3, true),
        ];
    }
}
