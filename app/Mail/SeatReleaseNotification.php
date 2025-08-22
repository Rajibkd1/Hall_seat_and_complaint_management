<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SeatReleaseNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $studentName;
    public $seatDetails;
    public $releaseReason;
    public $releasedBy;

    /**
     * Create a new message instance.
     */
    public function __construct($studentName, $seatDetails, $releaseReason, $releasedBy)
    {
        $this->studentName = $studentName;
        $this->seatDetails = $seatDetails;
        $this->releaseReason = $releaseReason;
        $this->releasedBy = $releasedBy;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Seat Release Notification - Hall Management System',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.seat_release_notification',
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
