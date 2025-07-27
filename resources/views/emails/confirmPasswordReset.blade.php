<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $mailData['subject'] }}</title>
</head>
<body>
    <h1>{{ $mailData['title'] }}</h1>

    <p>Hello {{ $mailData['user'] }},</p>

    <p>We have initiated a password reset for your account.</p>

    <p>Your new temporary password is: <strong>{{ $mailData['confirmation_code'] }}</strong></p>

    <p>Please use this temporary password to log in and reset your password immediately for security purposes.</p>

    <p>If you did not request a password reset, please contact us immediately.</p>

    <p>Thank you,<br>
    BCP Team</p>
</body>
</html>
