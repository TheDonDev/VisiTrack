<!DOCTYPE html>
<html>
<head>
    <title>Visit Booked</title>
</head>
<body>
    <h1>Your Visit has been Booked!</h1>
    <p>Dear {{ $visit->visitor_name }},</p>
    <p>Your visit details are as follows:</p>
    <ul>
        <li>Visit Number: {{ $visit->visit_number }}</li>
        <li>Host: {{ $visit->host->host_name }}</li>
        <li>Email: {{ $visit->host->host_email }}</li>
        <li>Phone: {{ $visit->host->host_number }}</li>
        <li>Purpose of Visit: {{ $visit->purpose_of_visit }}</li>
        <li>Visit Facility: {{ $visit->visit_facility }}</li>
        <li>Visit Date: {{ $visit->visit_date }}</li>
        <li>Visit Time: {{ $visit->visit_from }} - {{ $visit->visit_to }}</li>
    </ul>
    <p>Thank you for booking your visit!</p>
</body>
</html>
