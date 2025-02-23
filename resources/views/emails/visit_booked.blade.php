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
        <li>Host Name: {{ $host_name }}</li>
        <li>Host Email: {{ $host_email }}</li>
        <li>Host Phone Number: {{ $host_number }}</li>
        <li>Visit Date: {{ $visit_date }}</li>
        <li>Visit Time: {{ $visit_time }}</li>
    </ul>
    <p>Thank you for booking your visit!</p>
</body>
</html>
