<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VisitorJoined extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $visitor;
    public $visitNumber;
    public $visitDetails;

    public function __construct($visitor, $visitNumber, $visitDetails = null)
    {
        $this->visitor = $visitor;
        $this->visitNumber = $visitNumber;
        $this->visitDetails = $visitDetails ?? [
            'visit_date' => $visitor->visit_date ?? null,
            'visit_from' => $visitor->visit_from ?? null,
            'visit_to' => $visitor->visit_to ?? null,
            'purpose_of_visit' => $visitor->purpose_of_visit ?? null
        ];
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Visitor Joined Notification',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.visitor_joined',
            with: [
                'visitor' => $this->visitor,
                'visitNumber' => $this->visitNumber,
                'visitDetails' => $this->visitDetails
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
