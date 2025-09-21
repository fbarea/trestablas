<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Manager>
 */
class ManagerFactory extends Factory
{

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name(),
            'cargo' => $this->faker->randomElement([
                'Team leader',
                'Controller',
                'Advisor',
                'Manager'
            ]),
        ];
    }
}
