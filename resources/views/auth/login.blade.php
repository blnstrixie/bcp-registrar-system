<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/6cbb66e0e0.js" crossorigin="anonymous"></script>
        <link rel="icon" href="icons/favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="icons/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="css/login.css" type="text/css">
        <link rel="stylesheet" href="css/auth.css" type="text/css">

        <title> Login </title>
    </head>

    <body>
        <main class="container">
            <section class="left-side">
                <img class="illustration" src="{{ asset('svg/office.svg') }}" alt="Sign In Illustration">
            </section>

            <section class="right-side">
                <h1 class="title"> BCP - Bulacan Campus </h1>

            <!-- REMOVE
                <div class="user-role">
                    <div class="box" onclick="selectRole('Registrar')">
                        <img class="avatar" src="{{ asset('images/registrar.png') }}" alt="Registrar Avatar">
                        <div class="role"> Registrar </div>
                    </div>

                    <div class="box" onclick="selectRole('Student')">
                        <img class="avatar" src="{{ asset('images/student.png') }}" alt="Student Avatar">
                        <div class="role"> Student </div>
                    </div>
                </div>
            -->

                <div class="school-logo">
                    <img class="school-logo" src="{{ asset('images/bestlink-logo-2013.png') }}" alt="BCP Logo">
                </div>

                <p class="welcome-text"> Hello! Welcome to BCP Registrar System </p>

                <form action="{{ url('/attempt-login') }}" method="POST">
                    <div class="button-container">
                        @if(Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        @if(Session::has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('error') }}
                            </div>
                        @endif
                    @csrf
                    <div class="input-field-container">
                        <input type="hidden" name="role" id="role" value="">
                        <div class="input">
                            <i class="fa-solid fa-envelope"></i>
                            <input class="username" type="text" name="username" id="username" placeholder="Username" autocomplete="off" required>
                        </div>

                        <div class="input">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" name="password" id="password" placeholder="Password" autocomplete="off" required>

                            <div class="password-visibility">
                                <i class="fa-solid fa-eye"></i>
                            </div>
                        </div>

                        <div class="password-question">
                            <a href="{{ route('email-submission') }}"> Forgot Password? </a>
                        </div>
                    </div>
                        <button class="login-btn"> Login </button>
                    </div>
                </form>

            <!-- REMOVE
                <p class="account-question">
                    Don't have an account yet?
                    <span class="signup-link">
                        <a href="{{ route('auth/signup') }}"> Create an account </a>
                    </span>
                </p>
            -->

            </section>
        </main>

    <!-- REMOVE
        <script>
            function selectRole(role) {
                document.getElementById('role').value = role;
            }
        </script>
    -->

        <script src="js/select.js" defer></script>
        <script src="js/password-visibility.js" defer></script>
    </body>
</html>
