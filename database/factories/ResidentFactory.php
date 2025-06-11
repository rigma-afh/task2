<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\resident>
 */
class ResidentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>fake()->name(),
            'email'=> fake()->unique()->safeEmail(),
            'address'=> fake()->address(),
            'phone'=> fake()->phoneNumber(),
            'gender' => $this->faker->randomElement(['Male', 'Female']),
        ];
    }
}
