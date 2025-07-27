{{-- LINKS --}}
{{-- <a href="{{ route('teacher.upload-grades') }}" data-page-title="Upload Grades" onclick="handleClick(this, event)">
    <div class="sidebar-link">
        <i class="fa-solid fa-file-arrow-up"></i>
        <div class="tooltip"> Upload Grades </div>
    </div>
</a> --}}

<a href="{{ route('grades-list') }}">
    <div class="sidebar-link  {{ areActiveRoutes(['grades-list', 'grades-import-view']) }}">
        <i class="fa-solid fa-file-pen"></i>
        <div class="tooltip"> Grades </div>
    </div>
</a>

<a href="{{ route('audit-trail') }}">
    <div class="sidebar-link {{ areActiveRoutes(['audit-trail']) }}">
        <i class="fa-solid fa-clock-rotate-left"></i>
        <div class="tooltip"> Audit Trail </div>
    </div>
</a>
