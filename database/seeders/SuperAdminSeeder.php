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
        SuperAdmin::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'phone' => '1234567890',
            'password_hash' => Hash::make('password123'),
        ]);
    }
}
