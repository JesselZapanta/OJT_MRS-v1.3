<?php

namespace Database\Factories;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Intern>
 */
class InternFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'userId' => User::factory(),
            'id_number' => fake()->unique()->randomNumber(6),
            'year_level' => fake()->numberBetween(1, 4),
            'sex' => fake()->randomElement(['Male', 'Female']),
            'address' => fake()->address,
            'contact_number' => '09123456789',
            'date_of_birth' => '2024-01-20',
            'place_of_birth' => fake()->city,
            'age' => fake()->numberBetween(18, 25),
            'father' => fake()->name,
            'father_occupation' => fake()->jobTitle,
            'father_contact_no' => '09123456789',
            'mother' => fake()->name,
            'mother_occupation' => fake()->jobTitle,
            'mother_contact_no' => '09123456789',
            'guardian_address' => fake()->address,
            'guardian_contact_no' => '09123456789',
            'ojt_instructor' => fake()->name,
            'instructor_contact_no' => '09123456789',
        ];
    }
}
