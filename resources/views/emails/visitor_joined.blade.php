<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Joined Notification</title>
</head>
<body>
    <h1>Visitor Joined Notification</h1>
    <p>Dear {{ $visitor->name }},</p>
    <p>You have successfully joined the visit!</p>
    <p>Visit Number: {{ $visitNumber }}</p>
    <p>Host: {{ $host->name }}</p>
    <p>Host Email: {{ $host->email }}</p>
    <p>Host Number: {{ $host->number }}</p>
    <p>Thank you for using CheckMate!</p>
</body>
</html>
