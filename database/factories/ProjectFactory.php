<?php

namespace Database\Factories;

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
    public function definition()
    {
        return [
            'name' => fake()->bs,
            'description' => fake()->sentence($nbWords = 10, $variableNbWords = true),
            'start_date' => '2023-01-01',   
            'end_date' => fake()->dateTimeThisYear($max="2023-12-31"),
            'budget' => fake()->numberBetween($min = 1000, $max = 100000),
            'status' => fake()->numberBetween($min = 0, $max = 1),
        ];
    }
}
