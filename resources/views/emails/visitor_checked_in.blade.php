@component('mail::message')
# Visitor Check-In Notification

Dear {{ $visitorName }},

You have successfully checked in for your visit!

**Visit Details:**
- Visit Number: {{ $visitNumber }}
- Host Name: {{ $hostName }}

Thank you for using VisiTrack!

Best regards,
The VisiTrack Team
@endcomponent
