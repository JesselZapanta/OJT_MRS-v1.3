<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Company;
use App\Models\Intern;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //for admin
        // \App\Models\User::factory(1)->create();


        // Create 10 users within a loop
        for ($i = 0; $i < 10; $i++) {
        $user = User::factory()->create();

        Intern::factory()->create([
            'userId' => $user->id,
        ]);

        Company::factory()->create([
            'userId' => $user->id,
        ]);
    }
        

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
