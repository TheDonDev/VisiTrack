<!DOCTYPE html>
<html>
<head>
    <title>Verify Your Email Address</title>
</head>
<body>
    <p>Dear {{ $user->name }},</p>
    <p>Thank you for signing up! Please verify your email address by clicking the link below:</p>
    <a href="{{ $user->email_verification_url }}">Verify Email</a>
</body>
</html>
