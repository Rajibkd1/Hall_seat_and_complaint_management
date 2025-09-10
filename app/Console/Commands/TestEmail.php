<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomRenewalEmail;
use App\Models\SeatRenewalApplication;

class TestEmail extends Command
{
    protected $signature = 'test:email {email}';
    protected $description = 'Test email sending functionality';

    public function handle()
    {
        $email = $this->argument('email');

        // Create a mock renewal application for testing
        $renewalApplication = new SeatRenewalApplication();
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

        try {
            Mail::to($email)->send(new CustomRenewalEmail(
                $renewalApplication,
                'Test Email - Hall Seat Management',
                'This is a test email to verify email functionality.',
                'Test Admin'
            ));

            $this->info('Test email sent successfully to ' . $email);
            $this->info('Check your email inbox or the log file for the email content.');
        } catch (\Exception $e) {
            $this->error('Failed to send test email: ' . $e->getMessage());
            $this->error('Error details: ' . $e->getTraceAsString());
        }
    }
}
