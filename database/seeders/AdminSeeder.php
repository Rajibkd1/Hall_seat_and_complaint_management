<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Test Admin',
            'email' => 'admin@example.com',
            'password_hash' => Hash::make('password'),
            'phone' => '1234567890',
            'role' => 'Admin',
            'department' => 'IT Department',
            'teacher_id' => 'ADMIN001',
        ]);
    }
}
