<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class EmailService
{
    /**
     * Send email with timeout protection
     */
    public static function sendWithTimeout($mailable, $to, $timeout = 10)
    {
        try {
            // Set execution time limit
            set_time_limit($timeout);

            // Send email using the configured mail driver
            Mail::to($to)->send($mailable);

            Log::info('Email sent successfully', [
                'to' => $to,
                'mailable' => get_class($mailable),
                'timestamp' => now()
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('Email sending failed', [
                'to' => $to,
                'mailable' => get_class($mailable),
                'error' => $e->getMessage(),
                'timestamp' => now()
            ]);

            throw $e;
        }
    }

    /**
     * Send custom renewal email
     */
    public static function sendCustomRenewalEmail($renewalApplication, $subject, $message, $adminName)
    {
        $mailable = new \App\Mail\CustomRenewalEmail(
            $renewalApplication,
            $subject,
            $message,
            $adminName
        );

        return self::sendWithTimeout($mailable, $renewalApplication->student->email);
    }

    /**
     * Send template renewal email
     */
    public static function sendTemplateRenewalEmail($renewalApplication, $subject, $message, $additionalNotes, $adminName)
    {
        $mailable = new \App\Mail\TemplateRenewalEmail(
            $renewalApplication,
            $subject,
            $message,
            $additionalNotes,
            $adminName
        );

        return self::sendWithTimeout($mailable, $renewalApplication->student->email);
    }
}
