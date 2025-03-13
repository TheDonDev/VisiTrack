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
    public $visitDetails;

    public function __construct($visitor, $visitNumber, $host, $visitDetails = null)
    {
        $this->visitor = $visitor;
        $this->visitNumber = $visitNumber;
        $this->host = $host;
        $this->visitDetails = $visitDetails ?? [
            'visit_type' => $visitor->visit_type ?? null,
            'visit_facility' => $visitor->visit_facility ?? null,
            'visit_date' => $visitor->visit_date ?? null,
            'visit_from' => $visitor->visit_from ?? null,
            'visit_to' => $visitor->visit_to ?? null,
            'purpose_of_visit' => $visitor->purpose_of_visit ?? null
        ];
    }

    public function build()
    {
        return $this->view('emails.host_visit_notification')
                    ->with([
                        'visitor' => $this->visitor,
                        'visitNumber' => $this->visitNumber,
                        'host' => $this->host,
                        'visitDetails' => $this->visitDetails
                    ]);
    }
}
