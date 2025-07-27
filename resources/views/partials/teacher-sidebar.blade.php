<aside class="sidebar">
    <div class="top-side">
        <img class="school-logo" src="{{ asset('images/bestlink-logo-2013.png') }}">
    </div>

    <div class="middle-side">
        <a href="{{ route('teacher.dashboard') }}" data-page-title="Analytics" onclick="handleClick(this)">
            <div class="sidebar-link" id="dashboard-link">
                <i class="fa-solid fa-chart-pie"></i>
                <div class="tooltip"> Analytics </div>
            </div>
        </a>

        <a href="{{ route('teacher.upload-grades') }}" data-page-title="Upload Grades" onclick="handleClick(this, event)">
            <div class="sidebar-link">
                <i class="fa-solid fa-file-arrow-up"></i>
                <div class="tooltip"> Upload Grades </div>
            </div>
        </a>
    </div>

    <div class="bottom-side">

        <a href="{{ route('teacher.settings') }}" data-page-title="Settings" onclick="handleClick(this, event)">
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
