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
    public $visitNumber;
    public $host;

    public function __construct($visitor, $visitNumber, $host)
    {
        $this->visitor = $visitor;
        $this->visitNumber = $visitNumber;
        $this->host = $host;
    }

    public function build()
    {
        return $this->view('emails.host_visit_notification')
                    ->with([
                        'visitor' => $this->visitor,
                        'visitNumber' => $this->visitNumber,
                        'host' => $this->host
                    ]);
    }
}
