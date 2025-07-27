
<a href="{{ route('student/profile') }}">
    <div class="sidebar-link {{ areActiveRoutes(['student/profile','student.profile']) }}">
      <i class="fa-solid fa-id-card-clip"></i>
      <div class="tooltip"> My Profile </div>
    </div>
  </a>

  <a href="{{ route('student/documents-hub') }}">
    <div class="sidebar-link {{ areActiveRoutes(['student/documents-hub']) }}" >
      <i class="fa-solid fa-file"></i>
      <div class="tooltip"> Document Request and Status </div>
    </div>
  </a>
</div>
