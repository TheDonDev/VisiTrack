<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Mail\Mailable as MailableContract;
use Illuminate\Contracts\Queue\ShouldQueue;

class HostVisitNotification extends Mailable implements MailableContract
{
    use Queueable, SerializesModels;

    public $visitor;
    public $visit;
    public $host;

    public function __construct($visitor, $visit, $host)
    {
        $this->visitor = $visitor;
        $this->visit = $visit;
        $this->host = $host;
    }

    public function build()
    {
        // Determine which template to use based on the visit status
        $template = $this->template ??
            ($this->visit->status === 'joined' ? 'emails.host_visit_joined' : 'emails.host_visit_booked');

        return $this->view($template)
                    ->with([
                        'visitor' => $this->visitor,
                        'visit' => $this->visit,
                        'host' => $this->host,
                        'originalVisitor' => $this->visit->visitor
                    ]);
    }
}
