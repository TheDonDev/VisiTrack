<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Visit Booking Notification</title>
</head>
<body>
    <h1>New Visit Booking Notification</h1>
    <p>Dear {{ $host->host_name }},</p>
    <p>A new visit has been booked!</p>
    <p>Visitor Details:</p>
    <ul>
        <li>Name: {{ $visitorDetails->first_name }} {{ $visitorDetails->last_name }}</li>
        <li>Email: {{ $visitorDetails->email }}</li>
        <li>Phone Number: {{ $visitorDetails->phone_number }}</li>
        <li>Visit Number: {{ $visitNumber }}</li>
        <li>Visit Type: {{ $visitorDetails->visit_type }}</li>
        <li>Visit Facility: {{ $visitorDetails->visit_facility }}</li>
        <li>Visit Date: {{ $visitorDetails->visit_date }}</li>
        <li>Visit Time: {{ $visitorDetails->visit_from }} - {{ $visitorDetails->visit_to }}</li>
        <li>Purpose of Visit: {{ $visitorDetails->purpose_of_visit }}</li>
    </ul>
    <p>Thank you for using VisiTrack!</p>
</body>
</html>
