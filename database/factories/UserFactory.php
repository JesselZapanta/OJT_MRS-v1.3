<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //for admin
        // return [
        //     'lastname' => 'admin',
        //     'firstname' => 'admin',
        //     'middlename' => 'admin',
        //     'email' => 'admin@gmail.com',
        //     // 'email' => fake()->unique()->email(),
        //     'email_verified_at' => now(),
        //     'password' => static::$password ??= Hash::make('admin'),
        //     'remember_token' => Str::random(10),
        //     'status' => 'approved',
        //     'userole' => 'admin',
        //     'institute' => 'ojt',
        //     // 'institute' => 'ics',
        //     'program' => null,
        //     'profile' => 'profile.jpg'
        // ];
        return [
            'lastname' => fake()->lastName,
            'firstname' => fake()->firstName,
            'middlename' => fake()->lastName,
            'email' => fake()->unique()->safeEmail, // Replace with custom email generation
            'password' => bcrypt('password'),
            'status' => 'pending',
            'userole' => 'intern',
            'institute' => fake()->company,
            'institute' => fake()->randomElement(['ias', 'ibfs', 'ics', 'icje', 'ihs', 'ite']),
            'program' => null,
            'profile' => 'profile.jpg'
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
