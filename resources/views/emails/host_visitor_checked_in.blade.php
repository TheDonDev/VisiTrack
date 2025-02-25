@component('mail::message')
# Visitor Checked In Notification

Hello {{ $visit->host->host_name }},

This is to inform you that a visitor has checked in for visit {{ $visit->visit_number }}.

**Visitor Details:**
- Name: {{ $visit->visitor->visitor_name }} {{ $visit->visitor->visitor_last_name }}
- Organization: {{ $visit->visitor->organization }}
- Visit Date: {{ $visit->visit_date->format('Y-m-d') }}
- Visit Time: {{ $visit->visit_from }} to {{ $visit->visit_to }}

Thank you for using VisiTrack!

Best regards,
The VisiTrack Team
@endcomponent
