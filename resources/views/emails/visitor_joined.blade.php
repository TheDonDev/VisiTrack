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
        @if(isset($message))
            <h1>New Visitor Joined Your Visit</h1>
            <p>Dear Visitor,</p>
            <p>A new visitor has joined your visit:</p>
            <div class="details">
                <p><strong>Joining Visitor Details:</strong></p>
                <p>Name: {{ $joining_visitor['visitor_name'] }} {{ $joining_visitor['visitor_last_name'] }}</p>
                <p>Email: {{ $joining_visitor['visitor_email'] }}</p>
                <p>Phone: {{ $joining_visitor['visitor_number'] }}</p>
                <p>ID Number: {{ $joining_visitor['id_number'] }}</p>
                <p>Designation: {{ $joining_visitor['designation'] }}</p>
                <p>Organization: {{ $joining_visitor['organization'] }}</p>
                <p>Visit Number: {{ $visitNumber }}</p>
                <p>Visit Date: {{ $visit->visit_date }}</p>
                <p>Visit Time: {{ $visit->visit_from }} - {{ $visit->visit_to }}</p>
                <p>Purpose of Visit: {{ $visit->purpose_of_visit }}</p>
            </div>
        @else
            <h1>Visit Joined Successfully</h1>
            <p>Dear {{ $visitor_name }},</p>
            <p>You have successfully joined the visit!</p>
            <div class="details">
                <p><strong>Visit Details:</strong></p>
                <p>Visit Number: {{ $visitNumber }}</p>
            </div>
        @endif
        
        <p>Thank you for using VisiTrack!</p>
        
        <div class="footer">
            <p>Best regards,<br>The VisiTrack Team</p>
        </div>
    </div>
</body>
</html>
