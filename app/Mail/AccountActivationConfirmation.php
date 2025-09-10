<?php

namespace App\Mail;

use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountActivationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $student;

    /**
     * Create a new message instance.
     */
    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Account Activation Confirmation - NSTU Hall Management')
            ->view('emails.account_activation_confirmation')
            ->with([
                'student' => $this->student,
                'loginUrl' => route('student.auth', ['form_type' => 'login'])
            ]);
    }
}
