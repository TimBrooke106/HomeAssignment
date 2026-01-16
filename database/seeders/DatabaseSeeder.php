<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $categories = [
            'Brakes',
            'Suspension',
            'Cooling',
            'Intake',
            'Drivetrain',
            'Interior',
            'Exterior',
            'Fluids & Filters',
        ];

        foreach ($categories as $name) {
            \App\Models\Category::firstOrCreate(['name' => $name]);
        }
    }
}
