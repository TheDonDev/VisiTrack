<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class HostVisitJoined extends Mailable
{
    use Queueable, SerializesModels;

    public $joiningVisitor;
    public $visit;
    public $host;

    public function __construct($joiningVisitor, $visit, $host)
    {
        $this->joiningVisitor = $joiningVisitor;
        $this->visit = $visit;
        $this->host = $host;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Visitor Joined Your Visit',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.host_visit_joined',
            with: [
                'joiningVisitor' => $this->joiningVisitor,
                'visit' => $this->visit,
                'host' => $this->host,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
