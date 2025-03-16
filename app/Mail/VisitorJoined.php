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
    public $visit;
    public $isJoiningVisitor;
    public $originalVisitor;

    public function __construct($visitor, $visit, $isJoiningVisitor = true)
    {
        $this->visitor = $visitor;
        $this->visit = $visit;
        $this->isJoiningVisitor = $isJoiningVisitor;
        $this->originalVisitor = $visit->visitor;
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
                'originalVisitor' => $this->originalVisitor
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
