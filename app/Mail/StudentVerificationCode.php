<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class StudentVerificationCode extends Mailable
{
    public $code;

    public function __construct($code)
    {
        $this->code = $code;
    }

    public function build()
    {
        return $this->subject('Your Verification Code')
                    ->view('emails.student_verification_code');
    }
}