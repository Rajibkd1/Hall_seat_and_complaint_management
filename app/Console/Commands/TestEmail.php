<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminMessageEmail;

class TestEmail extends Command
{
    protected $signature = 'test:email {email}';
    protected $description = 'Test email configuration by sending a test email';

    public function handle()
    {
        $email = $this->argument('email');

        try {
            $this->info('Testing email configuration...');
            $this->info('MAIL_MAILER: ' . config('mail.default'));
            $this->info('MAIL_HOST: ' . config('mail.mailers.smtp.host'));
            $this->info('MAIL_PORT: ' . config('mail.mailers.smtp.port'));
            $this->info('MAIL_USERNAME: ' . config('mail.mailers.smtp.username'));
            $this->info('MAIL_FROM_ADDRESS: ' . config('mail.from.address'));
            $this->info('MAIL_FROM_NAME: ' . config('mail.from.name'));

            Mail::to($email)->send(new AdminMessageEmail(
                'Test Email from NSTU Hall Management',
                'This is a test email to verify SMTP configuration is working correctly.'
            ));

            $this->info('✅ Test email sent successfully to: ' . $email);
            return 0;
        } catch (\Exception $e) {
            $this->error('❌ Failed to send test email: ' . $e->getMessage());
            $this->error('Full error: ' . $e->getTraceAsString());
            return 1;
        }
    }
}
