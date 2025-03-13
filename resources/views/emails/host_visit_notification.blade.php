<!DOCTYPE html>
<html>
<head>
<style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        h1 {
            color: #2563eb;
        }
        .details {
            margin: 20px 0;
            padding: 15px;
            background: #f3f4f6;
            border-radius: 4px;
        }
        .details p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    @if(isset($message))
        <h1>New Visitor Joined Notification</h1>
        <p>Dear {{ $host->host_name }},</p>
        <p>A new visitor has joined the visit!</p>
        <div class="details">
            <p><strong>Joining Visitor Details:</strong></p>
            <p>Name: {{ $visitorDetails->visitor_name }} {{ $visitorDetails->visitor_last_name }}</p>
            <p>Email: {{ $visitorDetails->visitor_email }}</p>
            <p>Phone: {{ $visitorDetails->visitor_number }}</p>
            <p>Organization: {{ $visitorDetails->organization }}</p>
            <p>Visit Number: {{ $visitNumber }}</p>
        </div>
    @else
        <h1>New Visit Booking Notification</h1>
        <p>Dear {{ $host->host_name }},</p>
        <p>A new visit has been booked!</p>
        <div class="details">
            <p><strong>Visitor Details:</strong></p>
            <p>Name: {{ $visitorDetails->visitor_name }} {{ $visitorDetails->visitor_last_name }}</p>
            <p>Email: {{ $visitorDetails->visitor_email }}</p>
            <p>Phone Number: {{ $visitorDetails->visitor_number }}</p>
            <p>Visit Number: {{ $visitNumber }}</p>
            <p>Visit Type: {{ $visitorDetails->visit_type }}</p>
            <p>Visit Facility: {{ $visitorDetails->visit_facility }}</p>
            <p>Visit Date: {{ $visitorDetails->visit_date }}</p>
            <p>Visit Time: {{ $visitorDetails->visit_from }} - {{ $visitorDetails->visit_to }}</p>
            <p>Purpose of Visit: {{ $visitorDetails->purpose_of_visit }}</p>
        </div>
    @endif

    <p>Thank you for using VisiTrack!</p>

    <p>Best regards,<br>
    The VisiTrack Team</p>
</body>
</html>
