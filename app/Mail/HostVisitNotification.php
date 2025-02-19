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

    public function __construct($validatedData, $visitNumber, $host)
    {
        $this->validatedData = $validatedData;
        $this->visitNumber = $visitNumber;
        $this->host = $host;
    }

    public function build()
    {
        return $this->view('emails.hostVisitNotification')
                    ->with([
                        'validatedData' => $this->validatedData,
                        'visitNumber' => $this->visitNumber,
                        'host' => $this->host,
                    ]);
    }
}