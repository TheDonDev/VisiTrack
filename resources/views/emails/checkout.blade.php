<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Notification</title>
</head>
<body>
    <h1>Checkout Notification</h1>
    <p>Dear {{ $visitor->name }},</p>
    <p>You have successfully checked out!</p>
    <p>Visit Number: {{ $visitNumber }}</p>
    <p>Host: {{ $host->name }}</p>
    <p>Host Email: {{ $host->email }}</p>
    <p>Host Number: {{ $host->number }}</p>
    <p>Thank you for visiting!</p>
</body>
</html>
