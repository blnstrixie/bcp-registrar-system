@php
    $user = Auth::user();
@endphp
<header class="header">
    <div class="left-side">
        <i class="fa-solid fa-bars" id="hamburger-icon"></i>

        <div class="selected-nav-label" id="selected-nav-label" style="text-transform: none !important;">
            Home
        </div>
    </div>

    <div class="right-side">
        @if ($user->role == 'Student')
            <div class="notif" id="student_notif" style=" margin-right: 20px; margin-top: 10px;">
                <div>
                    <ul class="notification-drop" style="list-style: none;">
                        <li class="item">
                            <i class="fa fa-bell-o notification-bell" aria-hidden="true"></i>
                            {{-- <span class="btn__badge "> 0</span> --}}
                        </li>
                    </ul>
                </div>
            </div>
        @endif



        @if ($user->avatar)
            <img class="avatar" src="{{ asset($user->avatar) }}">
        @else
            <img class="avatar" src="{{ asset('images/sawako.jpg') }}">
        @endif

        <div class="profile">
            <div class="name">
                {{ $user->firstname }} {{ $user->middlename }} {{ $user->lastname }}
            </div>

            <div class="role">
                {{ $user->role }}
            </div>
        </div>
    </div>
</header>
