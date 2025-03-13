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
            <p>Name: {{ $visitor->visitor_name }} {{ $visitor->visitor_last_name }}</p>
            <p>Email: {{ $visitor->visitor_email }}</p>
            <p>Phone: {{ $visitor->visitor_number }}</p>
            <p>ID Number: {{ $visitor->id_number }}</p>
            <p>Designation: {{ $visitor->designation }}</p>
            <p>Organization: {{ $visitor->organization }}</p>
            <p>Visit Number: {{ $visitNumber }}</p>
            <p>Visit Date: {{ $visit->visit_date }}</p>
            <p>Visit Time: {{ $visit->visit_from }} - {{ $visit->visit_to }}</p>
            <p>Purpose of Visit: {{ $visit->purpose_of_visit }}</p>
        </div>
    @else
        <h1>New Visit Booking Notification</h1>
        <p>Dear {{ $host->host_name }},</p>
        <p>A new visit has been booked!</p>
        <div class="details">
            <p><strong>Visitor Details:</strong></p>
            <p>Name: {{ $visitor->visitor_name }} {{ $visitor->visitor_last_name }}</p>
            <p>Email: {{ $visitor->visitor_email }}</p>
            <p>Phone Number: {{ $visitor->visitor_number }}</p>
            <p>Visit Number: {{ $visitNumber }}</p>
            <p>Visit Type: {{ $visitDetails['visit_type'] }}</p>
            <p>Visit Facility: {{ $visitDetails['visit_facility'] }}</p>
            <p>Visit Date: {{ $visitDetails['visit_date'] }}</p>
            <p>Visit Time: {{ $visitDetails['visit_from'] }} - {{ $visitDetails['visit_to'] }}</p>
            <p>Purpose of Visit: {{ $visitDetails['purpose_of_visit'] }}</p>
        </div>
    @endif

    <p>Thank you for using VisiTrack!</p>

    <p>Best regards,<br>
    The VisiTrack Team</p>
</body>
</html>
