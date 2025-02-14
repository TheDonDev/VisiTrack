<?php

namespace App\Mail;

use App\Models\Visit; // Import the Visit model
use App\Models\Host; // Import the Host model
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VisitBooked extends Mailable
{
    use Queueable, SerializesModels;

    protected $visit; // Declare the visit property

    /**
     * Create a new message instance.
     */
    public function __construct(Visit $visit)
    {
        $this->visit = $visit; // Assign the visit object
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
                'visitor_name' => $this->visit->visitor_name,
                'visit_date' => $this->visit->visit_date,
                'visit_time' => $this->visit->visit_from . ' - ' . $this->visit->visit_to,
                'host_name' => Host::find($this->visit->host_id)->name,
                'visit_number' => $this->visit->visit_number, // Include visit number
                'visitor_email' => $this->visit->visitor_email, // Include visitor email
                'host_number' => Host::find($this->visit->host_id)->phone, // Include host phone number
            ] // Correctly close the with array
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
