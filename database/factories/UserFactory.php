<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_id' => $this->faker->uuid(),
            'first_name' => $this->faker->firstName(),
            'middle_name' => $this->faker->lastName(),
            'last_name' => $this->faker->lastName(),
            'username' => $this->faker->userName(),
            'email' => $this->faker->safeEmail(),
            'password' => bcrypt('test123'),
            'position' => $this->faker->jobTitle(),
            'course_program' => $this->faker->randomElement(['BSIT', 'MIT', 'BSCS', 'BSIS']),
            'dob' => $this->faker->randomElement(['January 24, 1987', 'January 24, 1987', 'January 24, 1987', 'January 24, 1987']),
            'age' => $this->faker->numberBetween(20, 60),
            'address' => $this->faker->address(),
            'last_login' => null,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
