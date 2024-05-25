<!DOCTYPE html>
<html>
<head>
    <title>Verify Your New Email Address</title>
</head>
<body>
    <p>Click the link below to verify your new email address:</p>
    <a href="{{ route('modify.email-verification', $token) }}">Verify Email</a>
</body>
</html>
