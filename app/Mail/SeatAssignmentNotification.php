<?php

namespace App\Mail;

use App\Models\SeatAllotment;
use App\Models\Student;
use App\Models\Seat;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SeatAssignmentNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $student;
    public $seat;
    public $allotment;

    /**
     * Create a new message instance.
     */
    public function __construct(Student $student, Seat $seat, SeatAllotment $allotment)
    {
        $this->student = $student;
        $this->seat = $seat;
        $this->allotment = $allotment;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Seat Assignment Confirmation - Hall Management System',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.seat_assignment_notification',
            with: [
                'studentName' => $this->student->name,
                'roomNumber' => $this->seat->room_number,
                'bedNumber' => $this->seat->bed_number,
                'floor' => $this->seat->floor,
                'block' => $this->seat->block,
                'startDate' => $this->allotment->start_date->format('F j, Y'),
                'allotmentId' => $this->allotment->allotment_id,
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
