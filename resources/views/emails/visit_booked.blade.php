<!DOCTYPE html>
<html>
<head>
    <title>Visit Booked</title>
</head>
<body>
    <h1>Your Visit has been Booked!</h1>
    <p>Dear {{ $visitor_name }},</p>
    <p>Your visit details are as follows:</p>
    <ul>
        <li>Visit Number: {{ $visit_number }}</li>
        <li>Host: {{ $host_name }}</li>
        <li>Email: {{ $visitor_email }}</li>
        <li>Phone: {{ $host_number }}</li>
        <li>Visit Date: {{ $visit_date }}</li>
        <li>Visit Time: {{ $visit_time }}</li>
    </ul>
    <p>Thank you for booking your visit!</p>
</body>
</html>
