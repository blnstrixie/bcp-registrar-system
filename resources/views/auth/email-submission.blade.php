<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/6cbb66e0e0.js" crossorigin="anonymous"></script>
        <link rel="icon" href="{{ asset('icons/favicon.ico') }}" type="image/x-icon">
        <link rel="shortcut icon" href="{{ asset('icons/favicon.ico') }}" type="image/x-icon">
        <link rel="stylesheet" href="{{ asset('css/verification.css') }}">

        <title> Account Recovery </title>
    </head>

    <body>
        <div id="container">
          <div id="title">Password Reset</div>

          <div class="text txt">Please provide your email to receive an OTP</div>

          <form action="{{ route('send-otp') }}" method="post">
            @csrf
            <input type="email" name="emailAdd" placeholder="Your Email" required>
            <button id="submitButton"> Submit </button>
          </form>
          @if(Session::has('error'))
              <div class="alert alert-danger" role="alert">
                  {{ Session::get('error') }}
              </div>
          @endif
        </main>
    </body>
</html>