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
    <h1>Your Visit has been Booked!</h1>
    <p>Dear {{ $visitor_name }},</p>
    <p>Your visit details are as follows:</p>
    <ul>
        <li><strong>Visit Number:</strong> {{ $visit_number }}</li>
        <li><strong>Host Name:</strong> {{ $host_name }}</li>
        <li><strong>Host Email:</strong> {{ $host_email }}</li>
        <li><strong>Host Phone Number:</strong> {{ $host_number }}</li>
        <li><strong>Visit Date:</strong> {{ $visit_date }}</li>
        <li><strong>Visit Time:</strong> {{ $visit_time }}</li>
        <li><strong>Visit Type:</strong> {{ $visit_type }}</li>
        <li><strong>Visit Facility:</strong> {{ $visit_facility }}</li>
    </ul>
    <p>Thank you for booking your visit!</p>
    <p>Best regards,<br>The VisiTrack Team</p>
</body>
</html>
