<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['MacLab 1', 'IT 09', 'IT 402', 'IT 10', 'IT 405', 'AVR', 'IT 08', 'IT 11', 'IT 12', 'IT 13'])
        ];
    }
}
