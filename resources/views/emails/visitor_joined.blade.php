@component('mail::message')
# Visitor Joined Notification

Dear {{ $visitor->name }},

You have successfully joined the visit!

**Visit Details:**
- Visit Number: {{ $visitNumber }}
- Host Name: {{ $host->name }}
- Host Email: {{ $host->email }}
- Host Phone Number: {{ $host->number }}

Thank you for using VisiTrack!

Best regards,
The VisiTrack Team
@endcomponent
