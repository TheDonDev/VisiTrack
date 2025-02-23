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

    public $validatedData;
    public $visitNumber;
    public $host;
    public $visitorDetails;

public function __construct($validatedData, $visitNumber, $host)
{
    $this->validatedData = $validatedData;
    $this->visitNumber = $visitNumber;
    $this->host = $host;
    $this->visitorDetails = (object) [
        'first_name' => $validatedData['visitor_name'],
        'last_name' => $validatedData['visitor_last_name'],
        'email' => $validatedData['visitor_email'],
        'phone_number' => $validatedData['visitor_number'],
        'visit_type' => $validatedData['visit_type'],
        'visit_facility' => $validatedData['visit_facility'],
        'visit_date' => $validatedData['visit_date'],
        'visit_from' => $validatedData['visit_from'],
        'visit_to' => $validatedData['visit_to'],
        'purpose_of_visit' => $validatedData['purpose_of_visit'],
    ];
}
public function build()
{
    return $this->view('emails.host_visit_notification')
                ->with([
                    'validatedData' => $this->validatedData,
                    'visitNumber' => $this->visitNumber,
                    'host' => $this->host,
                    'visitorDetails' => $this->visitorDetails,
                ]);
    }
}
