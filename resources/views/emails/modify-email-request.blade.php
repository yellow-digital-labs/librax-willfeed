<!DOCTYPE html>
<html>
<head>
    <title>Verify Your New Email Address</title>
</head>
<body>
    <p>Click the link below to verify your new email address:</p>
    <a href="{{ route('modify.email-verification', $mailData['token'] ) }}" style="padding:0 5px; font-size:16px">Verify Email</a>
</body>
</html>
