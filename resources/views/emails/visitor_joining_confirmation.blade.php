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
        <h1>Visit Joining Confirmation</h1>
        <p>Dear {{ $visitor->visitor_name }} {{ $visitor->visitor_last_name }},</p>
        <p>You have successfully joined the following visit:</p>

        <div class="details">
            <p><strong>Visit Details:</strong></p>
            <p>Visit Number: {{ $visit->visit_number }}</p>
            <p>Visit Date: {{ $visit->visit_date }}</p>
            <p>Visit Time: {{ $visit->visit_from }} - {{ $visit->visit_to }}</p>
            <p>Purpose of Visit: {{ $visit->purpose_of_visit }}</p>
            <p>Visit Facility: {{ $visit->visit_facility }}</p>
            <p>Visit Type: {{ $visit->visit_type }}</p>
        </div>

        <div class="details">
            <p><strong>Host Details:</strong></p>
            <p>Host Name: {{ $visit->host->host_name }}</p>
            <p>Host Email: {{ $visit->host->host_email }}</p>
            <p>Host Phone: {{ $visit->host->host_number }}</p>
        </div>

        <p>Thank you for using VisiTrack!</p>

        <div class="footer">
            <p>Best regards,<br>The VisiTrack Team</p>
        </div>
    </div>
</body>
</html>
