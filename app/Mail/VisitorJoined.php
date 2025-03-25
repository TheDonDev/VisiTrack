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

    public $visitor; // The visitor receiving the email (joining or original)
    public $visit;
    public $isJoiningVisitor; // True if the visitor is joining, false if original
    public $originalVisitor; // The visitor who booked the visit

    public function __construct($visitor, $visit, $isJoiningVisitor = true)
    {
        $this->visitor = $visitor;
        $this->visit = $visit;
        $this->isJoiningVisitor = $isJoiningVisitor;
        $this->originalVisitor = $visit->visitor; // Get the original visitor from the visit
    }

    public function envelope(): Envelope
    {
        $subject = $this->isJoiningVisitor
            ? 'Visit Joining Confirmation'
            : 'New Visitor Joined Your Visit';

        return new Envelope(
            subject: $subject,
        );
    }

    public function content(): Content
    {
        $template = $this->isJoiningVisitor
            ? 'emails.visitor_joining_confirmation'
            : 'emails.visitor_joined';

        return new Content(
            markdown: $template,
            with: [
                'visitor' => $this->visitor,
                'visit' => $this->visit,
                'originalVisitor' => $this->originalVisitor, // Pass original visitor data
            ]
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
