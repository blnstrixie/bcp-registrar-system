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

    <p>Your password has been successfully reset.</p>

    <p>Your new password is: <strong>{{ $mailData['new_password'] }}</strong></p>

    <p>Please log in using this new password and consider changing it to something more memorable once you're logged in.</p>

    <p>If you did not initiate this password reset, please contact us immediately.</p>

    <p>Thank you,<br>
    [Your Company] Team</p>
</body>
</html>
