@php
    $user = Auth::user();
    return redirect()->route('user.dashboard');
@endphp
<header class="header">
    <div class="left-side">
        <i class="fa-solid fa-bars" id="hamburger-icon"></i>

        <div class="selected-nav-label" id="selected-nav-label">
            Analytics
        </div>
    </div>

    <div class="right-side">
        @if($user->avatar)
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
