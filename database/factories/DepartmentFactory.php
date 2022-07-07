<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'dep_name' => fake()->jobTitle,
            'dep_description' => fake()->catchPhrase,
            'dep_status' => fake()->numberBetween($min=0,$max=1),
        ];
    }
}
