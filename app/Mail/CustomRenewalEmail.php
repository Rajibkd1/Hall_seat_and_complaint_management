<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\SeatRenewalApplication;

class CustomRenewalEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $renewalApplication;
    public $subject;
    public $emailMessage;
    public $adminName;

    /**
     * Create a new message instance.
     */
    public function __construct(SeatRenewalApplication $renewalApplication, $subject, $message, $adminName)
    {
        $this->renewalApplication = $renewalApplication;
        $this->subject = $subject;
        $this->emailMessage = $message;
        $this->adminName = $adminName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.custom_renewal_email',
            with: [
                'renewalApplication' => $this->renewalApplication,
                'subject' => $this->subject,
                'emailMessage' => $this->emailMessage,
                'adminName' => $this->adminName,
            ]
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
