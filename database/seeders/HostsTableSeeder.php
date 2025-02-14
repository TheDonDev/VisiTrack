<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Host; // Import the Host model

class HostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Host::create([
            'host_name' => 'John Doe',
            'host_email' => 'john.doe@example.com',
            'host_number' => '1234567890',
        ]);

        Host::create([
            'host_name' => 'Jane Smith',
            'host_email' => 'jane.smith@example.com',
            'host_number' => '0987654321',
        ]);

        Host::create([
            'host_name' => 'Alice Johnson',
            'host_email' => 'alice.johnson@example.com',
            'host_number' => '1122334455',
        ]);
    }
}