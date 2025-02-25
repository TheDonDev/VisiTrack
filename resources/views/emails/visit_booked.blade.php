@component('mail::message')
# Your Visit has been Booked!

Dear {{ $visitor_name }},

Your visit details are as follows:

**Visit Details:**
- Visit Number: {{ $visit_number }}
- Host Name: {{ $host_name }}
- Host Email: {{ $host_email }}
- Host Phone Number: {{ $host_number }}
- Visit Date: {{ $visit_date }}
- Visit Time: {{ $visit_time }}
- Visit Type: {{ $visit_type }}
- Visit Facility: {{ $visit_facility }}

Thank you for booking your visit!

Best regards,
The VisiTrack Team
@endcomponent
