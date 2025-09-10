<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestSimpleEmail extends Command
{
    protected $signature = 'test:simple-email {email}';
    protected $description = 'Test simple email sending';

    public function handle()
    {
        $email = $this->argument('email');

        try {
            Mail::raw('This is a test email to verify email functionality.', function ($message) use ($email) {
                $message->to($email)
                    ->subject('Test Email - Hall Seat Management');
            });

            $this->info('Test email sent successfully to ' . $email);
        } catch (\Exception $e) {
            $this->error('Failed to send test email: ' . $e->getMessage());
        }
    }
}
