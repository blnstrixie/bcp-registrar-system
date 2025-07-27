<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="{{ asset('icons/favicon.ico') }}" type="image/x-icon">
        <link rel="shortcut icon" href="{{ asset('icons/favicon.ico') }}" type="image/x-icon">
        <link rel="stylesheet" href="{{ asset('css/verification.css') }}">

        <title> Account Verification </title>
    </head>

    <body>
    <div id="container">
        <div id="title"> Verify Your Account </div>
        <div class="text"> We emailed you the four-digit code to <strong id='email'> </strong></div>
        <div class="text txt"> Enter the code below to confirm your email address </div>

        <form action="{{ route('confirm-password') }}" method="POST">
            @csrf
            <div id="codeInput">
                <input class="codeBox" type="text" name="confirmation_code[]" maxlength="1" oninput="moveToNext(this)">
                <input class="codeBox" type="text" name="confirmation_code[]" maxlength="1" oninput="moveToNext(this)">
                <input class="codeBox" type="text" name="confirmation_code[]" maxlength="1" oninput="moveToNext(this)">
                <input class="codeBox" type="text" name="confirmation_code[]" maxlength="1" oninput="moveToNext(this)">
            </div>
    
            <button id="verifyButton" onclick="verifyCode()" disabled> Verify </button>
        </form>
        @if(Session::has('error'))
              <div class="alert alert-danger" role="alert">
                  {{ Session::get('error') }}
              </div>
        @endif
        <div id="resend">Didn't receive the code? <span id="resendText">Wait <span id="timer"> </span>s</span>
    </div>

        <script>
            const email = "{{ session('email') }}";
            document.getElementById('email').innerText = email;
        </script>
        <script src="{{ asset('js/otp.js') }}"></script>
    </body>
</html>
