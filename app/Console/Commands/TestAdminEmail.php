<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SeatRenewalApplication;
use App\Models\Student;
use App\Models\SeatAllotment;
use App\Models\Seat;
use App\Models\Admin;
use App\Services\EmailService;

class TestAdminEmail extends Command
{
    protected $signature = 'test:admin-email';
    protected $description = 'Test admin email functionality';

    public function handle()
    {
        $this->info('Testing admin email functionality...');

        try {
            // Create test data
            $this->info('Creating test data...');

            // Create a test student
            $student = Student::first();
            if (!$student) {
                $this->error('No students found in database. Please run seeders first.');
                return;
            }

            // Create a test seat allotment
            $seatAllotment = SeatAllotment::where('student_id', $student->student_id)->first();
            if (!$seatAllotment) {
                $this->error('No seat allotments found for student. Please create seat allotments first.');
                return;
            }

            // Create a test renewal application
            $renewalApplication = SeatRenewalApplication::where('student_id', $student->student_id)->first();
            if (!$renewalApplication) {
                $this->info('Creating test renewal application...');
                $renewalApplication = SeatRenewalApplication::create([
                    'student_id' => $student->student_id,
                    'allotment_id' => $seatAllotment->allotment_id,
                    'current_semester' => 6,
                    'last_semester_cgpa' => 3.5,
                    'result_file_path' => 'test_result.pdf',
                    'id_card_file_path' => 'test_id_card.pdf',
                    'additional_comments' => 'Test renewal application',
                    'status' => 'pending',
                    'submitted_at' => now(),
                ]);
            }

            // Get admin
            $admin = Admin::first();
            if (!$admin) {
                $this->error('No admin found. Please create admin first.');
                return;
            }

            $this->info('Test data created successfully!');
            $this->info("Student: {$student->name} ({$student->email})");
            $this->info("Admin: {$admin->name}");
            $this->info("Renewal Application ID: {$renewalApplication->renewal_id}");

            // Test custom email
            $this->info('Testing custom email...');
            EmailService::sendCustomRenewalEmail(
                $renewalApplication,
                'Test Custom Email - Hall Seat Management',
                'This is a test custom email to verify the admin email functionality works correctly.',
                $admin->name
            );
            $this->info('✅ Custom email sent successfully!');

            // Test template email
            $this->info('Testing template email...');
            EmailService::sendTemplateRenewalEmail(
                $renewalApplication,
                'Test Template Email - Hall Seat Management',
                'This is a test template email to verify the admin email functionality works correctly.',
                'This is additional test notes for the template email.',
                $admin->name
            );
            $this->info('✅ Template email sent successfully!');

            $this->info('🎉 All admin email tests passed!');
            $this->info('Check storage/logs/laravel.log for email content.');
        } catch (\Exception $e) {
            $this->error('❌ Test failed: ' . $e->getMessage());
            $this->error('Error type: ' . get_class($e));
            $this->error('File: ' . $e->getFile() . ':' . $e->getLine());
            $this->error('Trace: ' . $e->getTraceAsString());
        }
    }
}
