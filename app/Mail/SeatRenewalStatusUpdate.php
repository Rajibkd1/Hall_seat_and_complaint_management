<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\SeatRenewalApplication;

class SeatRenewalStatusUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public $renewalApplication;
    public $status;

    /**
     * Create a new message instance.
     */
    public function __construct(SeatRenewalApplication $renewalApplication, $status)
    {
        $this->renewalApplication = $renewalApplication;
        $this->status = $status;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = $this->status === 'approved'
            ? 'Seat Renewal Application Approved'
            : 'Seat Renewal Application Update';

        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.seat_renewal_status_update',
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
