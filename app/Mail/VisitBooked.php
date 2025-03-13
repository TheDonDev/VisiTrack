<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VisitBooked extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new message instance.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Visit Booked',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.visit_booked',
            with: [
                'visitor_name' => $this->data['visit']->visitor->visitor_name . ' ' . $this->data['visit']->visitor->visitor_last_name,
                'visit_date' => $this->data['visit']->visit_date,
                'visit_time' => $this->data['visit']->visit_from . ' - ' . $this->data['visit']->visit_to,
                'host_name' => $this->data['host_name'],
                'visit_number' => $this->data['visitNumber'],
                'host_email' => $this->data['host_email'],
                'host_number' => $this->data['host_number'],
                'visit_type' => $this->data['visit']->visit_type,
                'visit_facility' => $this->data['visit']->visit_facility,
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
