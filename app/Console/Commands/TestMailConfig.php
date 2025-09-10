<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;

class TestMailConfig extends Command
{
    protected $signature = 'test:mail-config';
    protected $description = 'Test mail configuration and send a simple email';

    public function handle()
    {
        $this->info('Testing mail configuration...');

        // Display current mail configuration
        $this->info('Current mail driver: ' . config('mail.default'));
        $this->info('SMTP host: ' . config('mail.mailers.smtp.host'));
        $this->info('SMTP port: ' . config('mail.mailers.smtp.port'));
        $this->info('SMTP timeout: ' . config('mail.mailers.smtp.timeout'));

        // Force log driver
        Config::set('mail.default', 'log');
        $this->info('Forced mail driver to: ' . config('mail.default'));

        try {
            $this->info('Attempting to send test email...');

            Mail::raw('This is a test email to verify mail configuration.', function ($message) {
                $message->to('test@example.com')
                    ->subject('Test Email - Mail Configuration');
            });

            $this->info('✅ Test email sent successfully!');
            $this->info('Check storage/logs/laravel.log for the email content.');
        } catch (\Exception $e) {
            $this->error('❌ Failed to send test email: ' . $e->getMessage());
            $this->error('Error type: ' . get_class($e));

            if (strpos($e->getMessage(), 'timeout') !== false) {
                $this->warn('This appears to be a timeout issue. The system may be trying to connect to SMTP.');
            }
        }
    }
}
