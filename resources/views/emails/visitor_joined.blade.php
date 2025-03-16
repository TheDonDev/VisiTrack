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
            <h1>New Visitor Joined Your Visit</h1>
            <p>Dear Visitor,</p>
            <p>A new visitor has joined your visit:</p>
            <div class="details">
                <p><strong>Joining Visitor Details:</strong></p>
                <p>Name: {{ $visitor->visitor_name }} {{ $visitor->visitor_last_name }}</p>
                <p>Email: {{ $visitor->visitor_email }}</p>
                <p>Phone: {{ $visitor->visitor_number }}</p>
                <p>ID Number: {{ $visitor->id_number }}</p>
                <p>Designation: {{ $visitor->designation }}</p>
                <p>Organization: {{ $visitor->organization }}</p>
                <p>Visit Number: {{ $visitNumber }}</p>
                <p>Visit Date: {{ $visitDetails['visit_date'] }}</p>
                <p>Visit Time: {{ $visitDetails['visit_from'] }} - {{ $visitDetails['visit_to'] }}</p>
                <p>Purpose of Visit: {{ $visitDetails['purpose_of_visit'] }}</p>
            </div>

        <p>Thank you for using VisiTrack!</p>

        <div class="footer">
            <p>Best regards,<br>The VisiTrack Team</p>
        </div>
    </div>
</body>
</html>
