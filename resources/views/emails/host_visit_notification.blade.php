@component('mail::message')
# New Visit Booking Notification

Dear {{ $host->host_name }},

A new visit has been booked!

**Visitor Details:**
- Name: {{ $visitorDetails->first_name }} {{ $visitorDetails->last_name }}
- Email: {{ $visitorDetails->email }}
- Phone Number: {{ $visitorDetails->phone_number }}
- Visit Number: {{ $visitNumber }}
- Visit Type: {{ $visitorDetails->visit_type }}
- Visit Facility: {{ $visitorDetails->visit_facility }}
- Visit Date: {{ $visitorDetails->visit_date }}
- Visit Time: {{ $visitorDetails->visit_from }} - {{ $visitorDetails->visit_to }}
- Purpose of Visit: {{ $visitorDetails->purpose_of_visit }}

Thank you for using VisiTrack!

Best regards,
The VisiTrack Team
@endcomponent
