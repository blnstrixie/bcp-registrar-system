<aside class="sidebar">
    <div class="top-side">
        <img class="school-logo" src="{{ asset('images/bestlink-logo-2013.png') }}">
    </div>

    <div class="middle-side">
        <a href="{{ route('admin.dashboard') }}" data-page-title="Analytics" onclick="handleClick(this)">
            <div class="sidebar-link" id="dashboard-link">
                <i class="fa-solid fa-chart-pie"></i>
                <div class="tooltip"> Analytics </div>
            </div>
        </a>

        <a href="{{ route('admin.registrar-users') }}" data-page-title="Registrar Users" onclick="handleClick(this, event)">
            <div class="sidebar-link">
                <i class="fa-solid fa-users"></i>
                <div class="tooltip"> Registrar Users </div>
            </div>
        </a>

        <a href="{{ route('admin.teacher-users') }}" data-page-title="Teacher Users" onclick="handleClick(this, event)">
            <div class="sidebar-link">
                <i class="fa-solid fa-chalkboard-user"></i>
                <div class="tooltip"> Teacher Users </div>
            </div>
        </a>

        <a href="{{ route('admin.student-users') }}" data-page-title="Student Users" onclick="handleClick(this, event)">
            <div class="sidebar-link">
                <i class="fa-solid fa-user-graduate"></i>
                <div class="tooltip"> Student Users </div>
            </div>
        </a>
    </div>

    <div class="bottom-side">

        <a href="{{ route('admin.settings') }}" data-page-title="Settings" onclick="handleClick(this, event)">
            <div class="sidebar-link">
                <i class="fa-solid fa-gear"></i>
                <div class="tooltip"> Settings </div>
            </div>
        </a>

        <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="d-flex" role="search">
            @csrf
            @method('DELETE')
            <button type="submit" style="border: none; background: none; padding: 0; margin: 0;" onclick="handleClick(event)">
              <div class="sidebar-link">
                <i class="fa-solid fa-right-from-bracket"></i>
                <div class="tooltip">Logout</div>
              </div>
            </button>
        </form>   
    </div>
</aside>
