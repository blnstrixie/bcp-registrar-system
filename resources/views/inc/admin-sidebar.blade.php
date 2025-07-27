{{-- LINKS --}}
<a href="{{ route('user-management') }}">
    <div class="sidebar-link {{ areActiveRoutes(['user-management','user-management.create','user-management.show']) }}">
        <i class="fa-solid fa-users"></i>
        <div class="tooltip"> User Management </div>
    </div>
</a>
<a href="{{ route('audit-trail') }}">
    <div class="sidebar-link {{ areActiveRoutes(['audit-trail']) }}">
        <i class="fa-solid fa-clock-rotate-left"></i>
        <div class="tooltip"> Audit Trail </div>
    </div>
</a>
