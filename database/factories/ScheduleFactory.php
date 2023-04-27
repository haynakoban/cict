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
         $times = array(
            '06:00 AM', '06:30 AM',
            '07:00 AM', '07:30 AM',
            '08:00 AM', '08:30 AM',
            '09:00 AM', '09:30 AM',
            '10:00 AM', '10:30 AM',
            '11:00 AM', '11:30 AM',
            '12:00 PM', '12:30 PM',
            '01:00 PM', '01:30 PM',
            '02:00 PM', '02:30 PM',
            '03:00 PM', '03:30 PM',
            '04:00 PM', '04:30 PM',
            '05:00 PM', '05:30 PM',
            '06:00 PM', '06:30 PM',
            '07:00 PM', '07:30 PM',
            '08:00 PM', '08:30 PM',
            '09:00 PM', '09:30 PM',
            '10:00 PM', '10:30 PM',
        );
        
        return [
            'user_id' => User::factory(),
            'room_id' => Room::factory(),
            'subject_name' => $this->faker->randomElement(['WMA 2', 'WMA 1', 'Com Lab 2', 'CISCO 1', 'OS', 'Com Prog 1', 'DS 1', 'Math']),
            'section_name' => $this->faker->randomElement(['1A', '1B', '1C', '2B', '2A', '3A', '3C', '4A', '4D', '4E']),
            'group' => $this->faker->randomElement(['G1', 'G2', 'BOTH']),
            'status' => $this->faker->randomElement(['Present', 'Absent', 'Not Visited']),
            'semester' => $this->faker->randomElement(['1st', '2nd', '3rd']),
            'day' => $this->faker->dayOfWeek(),
            'start_time' => $this->faker->randomElement($times),
            'end_time' => $this->faker->randomElement($times),
        ];
    }
}
