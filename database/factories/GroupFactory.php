<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    protected $model = Group::class;

    public function definition(): array
    {
        return [
            'id_course' => Course::inRandomOrder()->value('id') ?? Course::factory(),
            'name_group' => 'Группа ' . $this->faker->words(2, true),
        ];
    }
}
