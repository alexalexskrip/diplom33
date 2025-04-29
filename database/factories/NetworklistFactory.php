<?php

namespace Database\Factories;

use App\Models\Networklist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Networklist>
 */
class NetworklistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_networkList' => $this->faker->company(),
            'site_netWWorklist' => 'https://' . $this->faker->domainName(),
        ];
    }
}
