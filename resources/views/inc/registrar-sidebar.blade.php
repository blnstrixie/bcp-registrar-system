{{-- LINKS --}}
{{-- <a href="{{ route('teacher.upload-grades') }}" data-page-title="Upload Grades" onclick="handleClick(this, event)">
    <div class="sidebar-link">
        <i class="fa-solid fa-file-arrow-up"></i>
        <div class="tooltip"> Upload Grades </div>
    </div>
</a> --}}

{{-- <a href="{{ route('grades-list') }}">
    <div class="sidebar-link">
        <i class="fa-solid fa-file-pen"></i>
        <div class="tooltip"> Grades </div>
    </div>
</a> --}}

{{-- <a href="{{ route('registrar/students') }}" data-page-title="Students" onclick="handleClick(this)"> --}}
<a href="{{ route('students.page') }}">
    <div class="sidebar-link {{ areActiveRoutes(['students.page','students.view-profile','students.create']) }}">
        <i class="fa-solid fa-users"></i>
        <div class="tooltip"> Students </div>
    </div>
</a>
<a href="{{ route('courses') }}">
    <div class="sidebar-link {{ areActiveRoutes(['courses','courses.info','courses.info.year-level','courses.year-level','courses.info.year-level.timetable']) }}">
        <i class="fa-solid fa-book-open-reader"></i>
        <div class="tooltip"> Courses </div>
    </div>
</a>

<a href="{{ route('grades-list') }}">
    <div class="sidebar-link  {{ areActiveRoutes(['grades-list']) }}">
        <i class="fa-solid fa-file-pen"></i>
        <div class="tooltip"> Grades </div>
    </div>
</a>
<a href="{{ route('documents') }}">
    <div class="sidebar-link {{ areActiveRoutes(['documents']) }}">
        <i class="fa-solid fa-file-contract"></i>
        <div class="tooltip"> Documents </div>
    </div>
</a>


<a href="{{ route('reports.enrollment') }}">
    <div class="sidebar-link {{ areActiveRoutes(['reports.enrollment']) }}">
        <i class="fa-solid fa-chart-simple"></i>
        <div class="tooltip"> Enrollment Report </div>
    </div>
</a>

<a href="{{ route('audit-trail') }}">
    <div class="sidebar-link {{ areActiveRoutes(['audit-trail']) }}">
        <i class="fa-solid fa-clock-rotate-left"></i>
        <div class="tooltip"> Audit Trail </div>
    </div>
</a>
