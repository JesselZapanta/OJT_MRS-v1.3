<?php

namespace Database\Factories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
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
            'company_name' => fake()->company(),
            'company_address' => fake()->address(),
            'company_contact_number' => '09123456789',
            'date_of_application' => '2024-01-20',
            'position' => fake()->jobTitle(),
            'schedule' => 'MWF',
            'start_date' => '2024-01-20',
            'end_date' => '2024-01-20',
        ];
    }
}
