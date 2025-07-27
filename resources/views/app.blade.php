<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title')
    </title>
    <script src="https://kit.fontawesome.com/6cbb66e0e0.js" crossorigin="anonymous"></script>
    {{-- <link rel="icon" href="../icons/favicon.ico" type="image/x-icon"> --}}
    <link rel="icon" href="{{ asset('icons/favicon.ico') }}" type="image/x-icon">
    {{-- <link rel="shortcut icon" href="../icons/favicon.ico" type="image/x-icon"> --}}
    <link rel="shortcut icon" href="{{ asset('icons/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/general.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">

    <!-- Latest compiled and minified CSS -->

    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> --}}
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

    <!-- ALERTIFY CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />

    <style>
        a {
            text-decoration: none;
        }

        /* FOR LARAVEL PAGINATOR POSITION TO RIGHT */
        nav ul.pagination {
            justify-content: center;
        }

        .sidebar-link.active-link {
            background-color: #33333340;

            /* background: linear-gradient(180deg, rgba(84,144,240, 0.8), rgba(255, 255, 255, 0.2)) !important; */
            border-radius: 0 25px 25px 0;
        }

        .notification-drop {
            font-family: 'Ubuntu', sans-serif;
            color: #444;
        }

        .notification-drop .item {
            padding: 10px;
            font-size: 18px;
            position: relative;
            border-bottom: 1px solid #ddd;
        }

        .notification-drop .item:hover {
            cursor: pointer;
        }

        .notification-drop .item i {
            margin-left: 10px;
        }

        .notification-drop .item ul {
            display: none;
            position: absolute;
            top: 100%;
            background: #fff;
            left: -200px;
            right: 0;
            z-index: 1;
            border-top: 1px solid #ddd;
        }

        .notification-drop .item ul li {
            font-size: 16px;
            padding: 15px 0 15px 25px;
        }

        .notification-drop .item ul li:hover {
            background: #ddd;
            color: rgba(0, 0, 0, 0.8);
        }

        @media screen and (min-width: 500px) {
            .notification-drop {
                display: flex;
                justify-content: flex-end;
            }

            .notification-drop .item {
                border: none;
            }
        }



        .notification-bell {
            font-size: 20px;
        }

        .btn__badge {
            background: #FF5D5D;
            color: white;
            font-size: 12px;
            position: absolute;
            top: 0;
            right: 0px;
            padding: 3px 10px;
            border-radius: 50%;
        }

        .pulse-button {
            box-shadow: 0 0 0 0 rgba(255, 0, 0, 0.5);
            -webkit-animation: pulse 1.5s infinite;
        }

        .pulse-button:hover {
            -webkit-animation: none;
        }

        @-webkit-keyframes pulse {
            0% {
                -moz-transform: scale(0.9);
                -ms-transform: scale(0.9);
                -webkit-transform: scale(0.9);
                transform: scale(0.9);
            }

            70% {
                -moz-transform: scale(1);
                -ms-transform: scale(1);
                -webkit-transform: scale(1);
                transform: scale(1);
                box-shadow: 0 0 0 50px rgba(255, 0, 0, 0);
            }

            100% {
                -moz-transform: scale(0.9);
                -ms-transform: scale(0.9);
                -webkit-transform: scale(0.9);
                transform: scale(0.9);
                box-shadow: 0 0 0 0 rgba(255, 0, 0, 0);
            }
        }

        .notification-text {
            font-size: 14px;
            font-weight: bold;
        }

        .notification-text span {
            float: right;
        }
        form label {
            padding: 0 !important;
        }
        .notification-drop .item ul li:first-child:hover {
            background-color: transparent !important;
            cursor: default !important;
        }

    </style>

    @yield('links')

</head>

<body>
    @include('inc.navbar')
    {{-- SIDEBAR --}}
    <aside class="sidebar">
        <div class="top-side">
            <img class="school-logo" src="{{ asset('images/bestlink-logo-2013.png') }}">
        </div>
        <div class="middle-side">
            <a href="{{ route('user.dashboard') }}">
                <div class="sidebar-link {{ areActiveRoutes(['user.dashboard']) }}" id="dashboard-link">
                    <i class="fa-solid fa-home"></i>
                    <div class="tooltip"> Home </div>
                </div>
            </a>
            @if (Auth::user()->role == 'Admin')
                @include('inc.admin-sidebar')
            @elseif(Auth::user()->role == 'Registrar')
                @include('inc.registrar-sidebar')
            @elseif(Auth::user()->role == 'Teacher')
                @include('inc.teacher-sidebar')
            @elseif(Auth::user()->role == 'Student')
                @include('inc.student-sidebar')
            @endif
        </div>

        <div class="bottom-side">

            <a href="{{ route('account.settings') }}">
                <div class="sidebar-link {{ areActiveRoutes(['account.settings']) }}">
                    <i class="fa-solid fa-gear"></i>
                    <div class="tooltip"> Settings </div>
                </div>
            </a>

            <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="d-flex" role="search">
                @csrf
                <button type="submit" style="border: none; background: none; padding: 0; margin: 0;"
                    onclick="handleClick(event)">
                    <div class="sidebar-link">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <div class="tooltip">Logout</div>
                    </div>
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <main class="container">
        @yield('page-content')
    </main>

    @if(Auth::user()->role == 'Student')
        <!-- Show Notification Modal -->
        <div class="modal fade" id="showNotif" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Notification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container" id="notif_body">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script>
        document.getElementById("selected-nav-label").innerHTML = document.title;
    </script>

    {{-- BS MIN --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

    {{-- JQUERY --}}
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

    <!-- ALERTIFT JS -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script>
        @if (\Session::has('message'))
            alertify.set('notifier', 'position', 'top-center');
            alertify.success('{{ \Session::get('message') }}');
        @endif
        @if (\Session::has('error-message'))
            alertify.set('notifier', 'position', 'top-center');
            alertify.error('{{ \Session::get('error-message') }}');
        @endif
    </script>

    <script>

        @if (Auth::user()->role == 'Student')
            NotificationInit();
            function NotificationInit() {
                $.ajax({
                    type : 'GET',
                    url : '{{ route("notification.count") }}',
                    success: function (data) {
                        $('#student_notif').html(data);
                    }
                });
            }
            function showNotif(id) {
                // NotificationInit();
                console.log(id)
                $('#showNotif').modal('show');
                $.ajax({
                    type : 'GET',
                    url  : '{{ route("notification.view") }}',
                    data : {'id' : id},
                    success: function (data) {
                        $('#showNotif #notif_body').html(data);
                        NotificationInit();
                    }
                })
            }
        @endif
    </script>
    @yield('scripts')
</body>

</html>
