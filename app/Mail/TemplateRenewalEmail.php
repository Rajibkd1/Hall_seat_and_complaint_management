<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\SeatRenewalApplication;

class TemplateRenewalEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $renewalApplication;
    public $subject;
    public $emailMessage;
    public $additionalNotes;
    public $adminName;

    /**
     * Create a new message instance.
     */
    public function __construct(SeatRenewalApplication $renewalApplication, $subject, $message, $additionalNotes = null, $adminName)
    {
        $this->renewalApplication = $renewalApplication;
        $this->subject = $subject;
        $this->emailMessage = $message;
        $this->additionalNotes = $additionalNotes;
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
            view: 'emails.template_renewal_email',
            with: [
                'renewalApplication' => $this->renewalApplication,
                'subject' => $this->subject,
                'emailMessage' => $this->emailMessage,
                'additionalNotes' => $this->additionalNotes,
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
