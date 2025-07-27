<aside class="sidebar">
    <div class="top-side">
      <img class="school-logo" src="{{ asset('images/bestlink-logo-2013.png') }}">
    </div>

    <div class="middle-side">
      <a href="{{ route('student/dashboard') }}" data-page-title="Analytics" onclick="handleClick(this)">
        <div class="sidebar-link">
          <i class="fa-solid fa-chart-pie"></i>
          <div class="tooltip"> Analytics </div>
        </div>
      </a>

      <a href="{{ route('student/profile') }}" data-page-title="My Profile" onclick="handleClick(this)">
        <div class="sidebar-link">
          <i class="fa-solid fa-id-card-clip"></i>
          <div class="tooltip"> My Profile </div>
        </div>
      </a>

      <a href="{{ route('student/documents-hub') }}" data-page-title="Document Request and Status" onclick="handleClick(this)">
        <div class="sidebar-link">
          <i class="fa-solid fa-file"></i>
          <div class="tooltip"> Document Request and Status </div>
        </div>
      </a>
    </div>

    <div class="bottom-side">
      <a href="{{ route('student/settings') }}" data-page-title="Settings" onclick="handleClick(this, event)">
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