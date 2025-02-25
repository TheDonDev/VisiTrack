@component('mail::message')
# Checkout Notification

Dear {{ $visitor->name }},

You have successfully checked out!

**Visit Details:**
- Visit Number: {{ $visitNumber }}
- Host: {{ $host->name }}
- Host Email: {{ $host->email }}
- Host Number: {{ $host->number }}

Thank you for visiting!

Best regards,
The VisiTrack Team
@endcomponent
