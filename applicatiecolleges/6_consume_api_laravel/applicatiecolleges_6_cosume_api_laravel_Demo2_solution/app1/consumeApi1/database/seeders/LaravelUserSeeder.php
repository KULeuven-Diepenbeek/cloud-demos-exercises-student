<?php

namespace Database\Seeders;

use App\Models\LaravelUser;
use Illuminate\Database\Seeder;

class LaravelUserSeeder extends Seeder
{
    public function run()
    {
        // Define the users you want to create
        $users = [
            ['name' => 'John Doe', 'email' => 'john.doe@example.com'],
            ['name' => 'Jane Smith', 'email' => 'jane.smith@example.com'],
            ['name' => 'Alice Johnson', 'email' => 'alice.johnson@example.com'],
            ['name' => 'Bob Brown', 'email' => 'bob.brown@example.com'],
            ['name' => 'Charlie Green', 'email' => 'charlie.green@example.com'],
            ['name' => 'Emily Davis', 'email' => 'emily.davis@example.com'],
            ['name' => 'Michael Wilson', 'email' => 'michael.wilson@example.com'],
            ['name' => 'Sarah White', 'email' => 'sarah.white@example.com'],
            ['name' => 'David King', 'email' => 'david.king@example.com'],
            ['name' => 'Laura Scott', 'email' => 'laura.scott@example.com'],
        ];

        // Insert users into the database
        foreach ($users as $user) {
            LaravelUser::create($user);
        }
    }
}
