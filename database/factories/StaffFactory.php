<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Staff>
 */
class StaffFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'contact' => fake()->phoneNumber(),
            'birthdate' => fake()->date($format = 'Y-m-d', $max = '2000-01-01'),
            'department_id' => fake()->numberBetween($min = 1, $max = 100),
        ];
    }
}
