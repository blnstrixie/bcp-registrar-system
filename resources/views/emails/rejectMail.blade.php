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

    <p>Hello {{ $mailData['body'] }},</p>

    <p>We regret to inform you that your application has been rejected. We sincerely appreciate the time and effort you invested in the application process. If you have any questions or need further clarification regarding the rejection, please don't hesitate to contact us.</p>

    <p>Thank you,<br>
    [Your Company] Team</p>
</body>
</html>
