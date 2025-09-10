<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StudentCommunicationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $emailSubject;
    public $emailMessage;
    public $adminName;
    public $adminRole;
    public $isBulkEmail;

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $message, $adminName, $adminRole, $isBulkEmail = false)
    {
        $this->emailSubject = $subject;
        $this->emailMessage = $message;
        $this->adminName = $adminName;
        $this->adminRole = $adminRole;
        $this->isBulkEmail = $isBulkEmail;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->emailSubject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.student_communication',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
