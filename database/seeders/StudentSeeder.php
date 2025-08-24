<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::create([
            'name' => 'John Doe',
            'university_id' => 'STU001',
            'email' => 'student@test.com',
            'phone' => '01234567890',
            'department' => 'Computer Science',
            'session_year' => 2023,
            'current_address' => '123 Student Street, University Area',
            'permanent_address' => '456 Home Street, Hometown',
            'father_name' => 'Robert Doe',
            'mother_name' => 'Jane Doe',
            'guardian_alive_status' => true,
            'guardian_contact' => '01987654321',
            'password_hash' => Hash::make('password123'),
        ]);

        Student::create([
            'name' => 'Alice Smith',
            'university_id' => 'STU002',
            'email' => 'alice@test.com',
            'phone' => '01234567891',
            'department' => 'Business Administration',
            'session_year' => 2023,
            'current_address' => '789 Campus Road, University Area',
            'permanent_address' => '321 Family Avenue, Hometown',
            'father_name' => 'Michael Smith',
            'mother_name' => 'Sarah Smith',
            'guardian_alive_status' => true,
            'guardian_contact' => '01987654322',
            'password_hash' => Hash::make('password123'),
        ]);
    }
}
