<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    public function definition(): array
    {
        return [
            'course_id' => Course::inRandomOrder()->value('id') ?? Course::factory(),
            'name' => 'Группа ' . $this->faker->words(2, true),
        ];
    }
}
