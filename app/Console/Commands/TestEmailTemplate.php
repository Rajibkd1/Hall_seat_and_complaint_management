<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\CustomRenewalEmail;
use App\Models\SeatRenewalApplication;

class TestEmailTemplate extends Command
{
    protected $signature = 'test:email-template';
    protected $description = 'Test email template rendering';

    public function handle()
    {
        $this->info('Testing email template rendering...');

        try {
            // Create a mock renewal application for testing
            $renewalApplication = new SeatRenewalApplication();
            $renewalApplication->renewal_id = 'TEST-001';
            $renewalApplication->student = (object) [
                'name' => 'Test Student',
                'email' => 'test@example.com'
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

            $this->info('Creating custom renewal email...');

            $mailable = new CustomRenewalEmail(
                $renewalApplication,
                'Test Email - Hall Seat Management',
                'This is a test email to verify template rendering.',
                'Test Admin'
            );

            $this->info('Rendering email template...');

            // Try to render the email template
            $rendered = $mailable->render();

            $this->info('✅ Email template rendered successfully!');
            $this->info('Template length: ' . strlen($rendered) . ' characters');

            // Check if the content is in the rendered template
            if (strpos($rendered, 'Test Student') !== false) {
                $this->info('✅ Student name found in template');
            } else {
                $this->warn('❌ Student name not found in template');
            }

            if (strpos($rendered, 'This is a test email') !== false) {
                $this->info('✅ Email message found in template');
            } else {
                $this->warn('❌ Email message not found in template');
            }
        } catch (\Exception $e) {
            $this->error('❌ Failed to render email template: ' . $e->getMessage());
            $this->error('Error type: ' . get_class($e));
            $this->error('File: ' . $e->getFile() . ':' . $e->getLine());
        }
    }
}
