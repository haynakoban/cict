<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
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
            'day' => $this->faker->dayOfWeek(),
            'time' => $this->faker->time(),
            'status' => $this->faker->randomElement(['Present', 'Absent', 'Not Visited']),
            'comments' => null,
        ];
    }
}
