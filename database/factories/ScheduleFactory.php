<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'room_id' => Room::factory(),
            'subject_name' => $this->faker->randomElement(['WMA 2', 'WMA 1', 'Com Lab 2', 'CISCO 1', 'OS', 'Com Prog 1', 'DS 1', 'Math']),
            'section_name' => $this->faker->randomElement(['1A', '1B', '1C', '2B', '2A', '3A', '3C', '4A', '4D', '4E']),
            'group' => $this->faker->randomElement(['G1', 'G2', 'BOTH']),
            'status' => $this->faker->randomElement(['Present', 'Absent', 'Not Visited']),
            'semester' => $this->faker->randomElement(['1st', '2nd', '3rd']),
            'day' => $this->faker->dayOfWeek(),
            'start_time' => $this->faker->time(),
            'end_time' => $this->faker->time(),
        ];
    }
}
