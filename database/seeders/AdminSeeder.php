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
        // === PROVOSTS (Hall Administrators) ===

        // Shahidullah Hall Provost
        Admin::create([
            'name' => 'Dr. Mohammad Ali',
            'email' => 'provost.shahidullah@university.edu',
            'password_hash' => Hash::make('Provost@2024'),
            'phone' => '+8801711111111',
            'role' => 'Provost',
            'role_type' => 'provost',
            'designation' => 'Professor & Hall Provost',
            'hall_name' => 'Shahidullah Hall',
            'contact_number' => '+8801711111111',
            'department' => 'Department of English',
            'teacher_id' => 'PROF-ENG-001',
            'is_verified' => true,
            'verified_at' => now(),
        ]);

        // Salimullah Hall Provost
        Admin::create([
            'name' => 'Dr. Ayesha Khan',
            'email' => 'provost.salimullah@university.edu',
            'password_hash' => Hash::make('Provost@2024'),
            'phone' => '+8801722222222',
            'role' => 'Provost',
            'role_type' => 'provost',
            'designation' => 'Professor & Hall Provost',
            'hall_name' => 'Salimullah Muslim Hall',
            'contact_number' => '+8801722222222',
            'department' => 'Department of Physics',
            'teacher_id' => 'PROF-PHY-002',
            'is_verified' => true,
            'verified_at' => now(),
        ]);

        // Fazlul Huq Hall Provost
        Admin::create([
            'name' => 'Dr. Rahman Hossain',
            'email' => 'provost.fazlulhuq@university.edu',
            'password_hash' => Hash::make('Provost@2024'),
            'phone' => '+8801733333333',
            'role' => 'Provost',
            'role_type' => 'provost',
            'designation' => 'Professor & Hall Provost',
            'hall_name' => 'A.F. Rahman Hall',
            'contact_number' => '+8801733333333',
            'department' => 'Department of Chemistry',
            'teacher_id' => 'PROF-CHEM-003',
            'is_verified' => true,
            'verified_at' => now(),
        ]);

        // === CO-PROVOSTS (Assistant Hall Administrators) ===

        // Shahidullah Hall Co-Provost
        Admin::create([
            'name' => 'Dr. Sarah Ahmed',
            'email' => 'coprovost.shahidullah@university.edu',
            'password_hash' => Hash::make('CoProvost@2024'),
            'phone' => '+8801744444444',
            'role' => 'Co-Provost',
            'role_type' => 'co_provost',
            'designation' => 'Associate Professor & Assistant Provost',
            'hall_name' => 'Shahidullah Hall',
            'contact_number' => '+8801744444444',
            'department' => 'Department of Mathematics',
            'teacher_id' => 'ASSOC-MATH-001',
            'is_verified' => true,
            'verified_at' => now(),
        ]);

        // Salimullah Hall Co-Provost
        Admin::create([
            'name' => 'Dr. Kamal Uddin',
            'email' => 'coprovost.salimullah@university.edu',
            'password_hash' => Hash::make('CoProvost@2024'),
            'phone' => '+8801755555555',
            'role' => 'Co-Provost',
            'role_type' => 'co_provost',
            'designation' => 'Associate Professor & Assistant Provost',
            'hall_name' => 'Salimullah Muslim Hall',
            'contact_number' => '+8801755555555',
            'department' => 'Department of Computer Science',
            'teacher_id' => 'ASSOC-CSE-002',
            'is_verified' => true,
            'verified_at' => now(),
        ]);

        // === HALL STAFF (Maintenance & Support) ===

        // Shahidullah Hall Staff
        Admin::create([
            'name' => 'Md. Abdul Karim',
            'email' => 'staff.shahidullah@university.edu',
            'password_hash' => Hash::make('Staff@2024'),
            'phone' => '+8801766666666',
            'role' => 'Hall Staff',
            'role_type' => 'staff',
            'contact_number' => '+8801766666666',
            'department' => 'Hall Administration',
            'teacher_id' => 'STAFF-SHA-001',
            'is_verified' => true,
            'verified_at' => now(),
        ]);

        // Salimullah Hall Staff
        Admin::create([
            'name' => 'Ms. Fatema Begum',
            'email' => 'staff.salimullah@university.edu',
            'password_hash' => Hash::make('Staff@2024'),
            'phone' => '+8801777777777',
            'role' => 'Hall Staff',
            'role_type' => 'staff',
            'contact_number' => '+8801777777777',
            'department' => 'Hall Administration',
            'teacher_id' => 'STAFF-SAL-002',
            'is_verified' => true,
            'verified_at' => now(),
        ]);

        // Fazlul Huq Hall Staff
        Admin::create([
            'name' => 'Mr. Rahim Sheikh',
            'email' => 'staff.fazlulhuq@university.edu',
            'password_hash' => Hash::make('Staff@2024'),
            'phone' => '+8801788888888',
            'role' => 'Hall Staff',
            'role_type' => 'staff',
            'contact_number' => '+8801788888888',
            'department' => 'Hall Administration',
            'teacher_id' => 'STAFF-FAZ-003',
            'is_verified' => true,
            'verified_at' => now(),
        ]);

        // === IT ADMINISTRATORS (System Administrators) ===

        // System Administrator
        Admin::create([
            'name' => 'System Administrator',
            'email' => 'admin@university.edu',
            'password_hash' => Hash::make('Admin@2024'),
            'phone' => '+8801799999999',
            'role' => 'System Administrator',
            'role_type' => 'staff',
            'designation' => 'IT System Administrator',
            'contact_number' => '+8801799999999',
            'department' => 'IT Department',
            'teacher_id' => 'ADMIN-IT-001',
            'is_verified' => true,
            'verified_at' => now(),
        ]);

        // === ORIGINAL TEST ACCOUNTS (For backward compatibility) ===

        // Create a verified Provost account for testing
        Admin::create([
            'name' => 'Test Provost',
            'email' => 'provost@example.com',
            'password_hash' => Hash::make('password'),
            'phone' => '1234567890',
            'role' => 'Provost',
            'role_type' => 'provost',
            'designation' => 'Hall Provost',
            'hall_name' => 'Test Hall',
            'contact_number' => '1234567890',
            'department' => 'Administration',
            'teacher_id' => 'PROV001',
            'is_verified' => true,
            'verified_at' => now(),
        ]);

        // Create a verified Co-Provost account for testing
        Admin::create([
            'name' => 'Test Co-Provost',
            'email' => 'coprovost@example.com',
            'password_hash' => Hash::make('password'),
            'phone' => '1234567891',
            'role' => 'Co-Provost',
            'role_type' => 'co_provost',
            'designation' => 'Assistant Provost',
            'hall_name' => 'Test Hall',
            'contact_number' => '1234567891',
            'department' => 'Administration',
            'teacher_id' => 'COPROV001',
            'is_verified' => true,
            'verified_at' => now(),
        ]);

        // Create a verified Staff account for testing
        Admin::create([
            'name' => 'Test Staff',
            'email' => 'staff@example.com',
            'password_hash' => Hash::make('password'),
            'phone' => '1234567892',
            'role' => 'Staff',
            'role_type' => 'staff',
            'contact_number' => '1234567892',
            'department' => 'Maintenance',
            'teacher_id' => 'STAFF001',
            'is_verified' => true,
            'verified_at' => now(),
        ]);

        // Keep the original admin for backward compatibility
        Admin::create([
            'name' => 'Test Admin',
            'email' => 'admin@example.com',
            'password_hash' => Hash::make('password'),
            'phone' => '1234567890',
            'role' => 'Admin',
            'role_type' => 'staff',
            'department' => 'IT Department',
            'teacher_id' => 'ADMIN001',
            'is_verified' => true,
            'verified_at' => now(),
        ]);
    }
}
