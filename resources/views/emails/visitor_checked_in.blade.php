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
        <h1>Visitor Check-In Notification</h1>

        <p>Dear {{ $visit->visitor->first_name }} {{ $visit->visitor->last_name }},</p>

        <p>You have successfully checked in for your visit!</p>

        <div class="details">
            <p><strong>Visit Details:</strong></p>
            <p>Visit Number: {{ $visitNumber }}</p>
            <p>Host Name: {{ $hostName }}</p>
            <p>Host Number: {{ $hostNumber }}</p>
            <p>Host Email: {{ $hostEmail }}</p>
        </div>

        <p>Thank you for using VisiTrack!</p>

        <div class="footer">
            <p>Best regards,<br>The VisiTrack Team</p>
        </div>
    </div>
</body>
</html>
