<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Faculty;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition(): array
    {
        return [
            'id_faculty' => Faculty::inRandomOrder()->value('id') ?? Faculty::factory(),
            'name_course' => $this->faker->words(3, true),
        ];
    }
}
