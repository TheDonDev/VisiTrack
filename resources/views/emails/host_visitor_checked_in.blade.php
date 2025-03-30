<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Checked In</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #004080;
        }
        .details {
            margin-top: 20px;
        }
        .details p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Visitor Checked In</h1>
        <p>Hello {{ $visit->host->host_name }},</p>
        <p>Your visitor, {{ $visit->visitor->first_name }} {{ $visit->visitor->last_name }}, has checked in successfully.</p>
        <div class="details">
            <h2>Visit Details:</h2>
            <p><strong>Visit Number:</strong> {{ $visit->visit_number }}</p>
            <p><strong>Visitor Name:</strong> {{ $visit->visitor->first_name }} {{ $visit->visitor->last_name }}</p>
            <p><strong>Designation:</strong> {{ $visit->visitor->designation }}</p>
            <p><strong>Organization:</strong> {{ $visit->visitor->organization }}</p>
            <p><strong>Email:</strong> {{ $visit->visitor->email }}</p>
            <p><strong>Phone Number:</strong> {{ $visit->visitor->phone_number }}</p>
            <p><strong>Check-in Time:</strong> {{ $visit->check_in_time }}</p>
        </div>
        <p>Thank you for your attention!</p>
    </div>
</body>
</html>
