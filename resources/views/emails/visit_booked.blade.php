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
            margin-bottom: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
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
        .footer {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Your Visit has been Booked!</h1>
        
        <p>Dear {{ $visitor_name }},</p>
        
        <p>Your visit details are as follows:</p>
        
        <div class="details">
            <p><strong>Visit Details:</strong></p>
            <p>Visit Number: {{ $visit_number }}</p>
            <p>Host Name: {{ $host_name }}</p>
            <p>Host Email: {{ $host_email }}</p>
            <p>Host Phone Number: {{ $host_number }}</p>
            <p>Visit Date: {{ $visit_date }}</p>
            <p>Visit Time: {{ $visit_time }}</p>
            <p>Visit Type: {{ $visit_type }}</p>
            <p>Visit Facility: {{ $visit_facility }}</p>
        </div>
        
        <p>Thank you for booking your visit!</p>
        
        <div class="footer">
            <p>Best regards,<br>The VisiTrack Team</p>
        </div>
    </div>
</body>
</html>
