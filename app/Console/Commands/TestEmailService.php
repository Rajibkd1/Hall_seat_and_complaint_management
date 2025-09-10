<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\EmailService;

class TestEmailService extends Command
{
    protected $signature = 'test:email-service {email}';
    protected $description = 'Test email service with timeout protection';

    public function handle()
    {
        $email = $this->argument('email');

        $this->info('Testing email service with timeout protection...');

        try {
            // Create a mock renewal application for testing
            $renewalApplication = new \App\Models\SeatRenewalApplication();
            $renewalApplication->renewal_id = 'TEST-001';
            $renewalApplication->student = (object) [
                'name' => 'Test Student',
                'email' => $email
            ];
            $renewalApplication->allotment = (object) [
                'seat' => (object) [
                    'floor' => '1st',
                    'block' => 'A',
                    'room_number' => '101',
                    'bed_number' => '1'
                ]
            ];
            $renewalApplication->status = 'pending';

            $this->info('Sending custom renewal email...');

            EmailService::sendCustomRenewalEmail(
                $renewalApplication,
                'Test Email - Hall Seat Management',
                'This is a test email to verify email service functionality with timeout protection.',
                'Test Admin'
            );

            $this->info('✅ Custom renewal email sent successfully!');

            $this->info('Sending template renewal email...');

            EmailService::sendTemplateRenewalEmail(
                $renewalApplication,
                'Test Template Email - Hall Seat Management',
                'This is a test template email to verify email service functionality.',
                'This is additional test notes.',
                'Test Admin'
            );

            $this->info('✅ Template renewal email sent successfully!');
            $this->info('Check storage/logs/laravel.log for the email content.');
        } catch (\Exception $e) {
            $this->error('❌ Failed to send test email: ' . $e->getMessage());
            $this->error('Error type: ' . get_class($e));
        }
    }
}
