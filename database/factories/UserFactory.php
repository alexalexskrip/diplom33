<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = fake()->randomElement(['male', 'female']);

        return [
            'name' => fake()->userName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
//            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'password' => Hash::make('123456789'),
            'remember_token' => Str::random(10),
            'firstname' => fake()->firstName($gender),
            'lastname' => fake()->lastName($gender),
            'id_group' => Group::inRandomOrder()->value('id')
        ];
    }

    public function configure(): Factory|UserFactory
    {
        return $this->afterCreating(function ($user) {
            $projects = Project::query()->inRandomOrder()->take(rand(1, 3))->pluck('id');
            $user->projects()->attach($projects);
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
