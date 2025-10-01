<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Darrell',
            'email' => 'admin@admin.com',
            'role' => 'admin',
            'password' => Hash::make('admin123'),
        ]);

        // Create a sample employee user
        User::create([
            'name' => 'Employee',
            'email' => 'employee@employee.com',
            'role' => 'employee',
            'password' => Hash::make('employee123'),
        ]);
    }
}