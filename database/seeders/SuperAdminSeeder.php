<?php

namespace Database\Seeders;

use App\Models\SuperAdmin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Single Super Admin
        SuperAdmin::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@university.edu',
            'phone' => '+8801712345678',
            'password_hash' => Hash::make('password123'),
        ]);
    }
}
