<?php

namespace App\Mail;

use App\Models\Visit;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HostVisitorCheckedIn extends Mailable
{
    use Queueable, SerializesModels;

    public $visit;

    /**
     * Create a new message instance.
     *
     * @param Visit $visit
     * @return void
     */
    public function __construct(Visit $visit)
    {
        $this->visit = $visit;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Visitor Checked In Notification')
                    ->view('emails.host_visitor_checked_in')
                    ->with([
                        'visitorName' => $this->visit->visitor_name,
                        'visitNumber' => $this->visit->visit_number,
                    ]);
    }
}
