<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create(); // Keep this commented if you don't need 10 random users

        // Use firstOrCreate to find a user by email or create them if they don't exist
        User::firstOrCreate(
            ['email' => 'test@example.com'], // Attributes to find the user by
            [                                // Attributes to use IF creating a new user
                'name' => 'Test User',
                'password' => Hash::make('password'),
                // 'email_verified_at' => now(), // Optional: Add if you want the user verified
            ]
        );

        $this->call([
            HostsTableSeeder::class
        ]);
    }
}
