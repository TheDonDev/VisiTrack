<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Visit;

class HostVisitorCheckedIn extends Mailable
{
    use Queueable, SerializesModels;

    public $visit;

    public function __construct(Visit $visit)
    {
        $this->visit = $visit;
    }

    public function build()
    {
        return $this->markdown('emails.host_visitor_checked_in')
            ->subject('Visitor Checked In - ' . $this->visit->visit_number);
    }
}
