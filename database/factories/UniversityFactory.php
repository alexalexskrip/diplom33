<?php

namespace Database\Factories;

use App\Models\University;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\University>
 */
class UniversityFactory extends Factory
{
    protected $model = University::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name_university' => fake()->company(),
            'address_university' => fake()->streetAddress(),
            'phone_university' => fake()->numerify('+79#########'),
            'mail_university' => fake()->safeEmail()
        ];
    }
}
