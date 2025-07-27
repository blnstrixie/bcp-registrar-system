<aside class="sidebar">
    <div class="top-side">
        <img class="school-logo" src="{{ asset('images/bestlink-logo-2013.png') }}">
    </div>

    <div class="middle-side">
        <a href="{{ route('registrar/dashboard') }}" data-page-title="Analytics" onclick="handleClick(this)">
            <div class="sidebar-link" id="dashboard-link">
                <i class="fa-solid fa-chart-pie"></i>
                <div class="tooltip"> Analytics </div>
            </div>
        </a>

        <a href="{{ route('registrar/students') }}" data-page-title="Students" onclick="handleClick(this)">
            <div class="sidebar-link">
                <i class="fa-solid fa-users"></i>
                <div class="tooltip"> Students </div>
            </div>
        </a>

        <a href="{{ route('registrar/courses') }}" data-page-title="Courses" onclick="handleClick(this)">
            <div class="sidebar-link">
                <i class="fa-solid fa-book-open-reader"></i>
                <div class="tooltip"> Courses </div>
            </div>
        </a>

        <a href="{{ route('registrar/grades') }}" data-page-title="Grades" onclick="handleClick(this)">
            <div class="sidebar-link">
                <i class="fa-solid fa-file-pen"></i>
                <div class="tooltip"> Grades </div>
            </div>
        </a>

        <a href="{{ route('registrar/report') }}" data-page-title="Enrollment Report" onclick="handleClick(this)">
            <div class="sidebar-link">
                <i class="fa-solid fa-chart-simple"></i>
                <div class="tooltip"> Enrollment Report </div>
            </div>
        </a>

        <!-- Added December 5 -->
        <a href="{{ route('registrar/grade-report') }}" data-page-title="Grade Report" onclick="handleClick(this)">
            <div class="sidebar-link">
                <i class="fa-solid fa-clipboard"></i>
                <div class="tooltip"> Grade Report </div>
            </div>
        </a>

        <!-- Added December 11 -->
        <a href="{{ route('audit-trail') }}" data-page-title="Audit Trail" onclick="handleClick(this)">
            <div class="sidebar-link">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <div class="tooltip"> Audit Trail </div>
            </div>
        </a>

    <!-- REMOVE
        <a href="{{ route('registrar/accounts') }}" data-page-title="Student Accounts" onclick="handleClick(this)">
            <div class="sidebar-link">
                <i class="fa-solid fa-users-viewfinder"></i>
                <div class="tooltip"> Student Accounts </div>
            </div>
        </a>
    -->

    </div>

    <div class="bottom-side">

        <a href="{{ route('registrar/settings') }}" data-page-title="Settings" onclick="handleClick(this, event)">
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
