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
        <h1>Visitor Checked In Notification</h1>
        
        <p>Hello {{ $visit->host->host_name }},</p>
        
        <p>This is to inform you that a visitor has checked in for visit {{ $visit->visit_number }}.</p>
        
        <div class="details">
            <p><strong>Visitor Details:</strong></p>
            <p>Name: {{ $visit->visitor->visitor_name }} {{ $visit->visitor->visitor_last_name }}</p>
            <p>Email: {{ $visit->visitor->visitor_email }}</p>
            <p>Phone Number: {{ $visit->visitor->visitor_number }}</p>
            <p>Visit Number: {{ $visit->visit_number }}</p>
            <p>Organization: {{ $visit->visitor->organization }}</p>
            <p>Visit Date: {{ $visit->visit_date->format('Y-m-d') }}</p>
            <p>Visit Time: {{ $visit->visit_from }} to {{ $visit->visit_to }}</p>
        </div>
        
        <p>Thank you for using VisiTrack!</p>
        
        <div class="footer">
            <p>Best regards,<br>The VisiTrack Team</p>
        </div>
    </div>
</body>
</html>
