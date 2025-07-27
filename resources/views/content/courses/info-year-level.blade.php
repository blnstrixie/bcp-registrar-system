@extends('app')

@section('title', 'Courses Info: ' . $course->program)

@section('links')

    {{-- <link rel="stylesheet" href="{{ asset('css/grid-cards.css') }}"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('page-content')
@php
    $yearLevel = DB::table('yearlevels')->where('level', $year)->where('course_id', $course->id)->first();
@endphp
    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <label>Course: <strong>{{ $course->code }}</strong></label>
                </div>
                <div class="col-6">
                    <label>Year Level: <strong>{{ $yearLevel->year_levels ?? '' }}</strong></label>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3 shadow-sm">
        <div class="card-body">
            <div class="content-title  mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>Subjects</div>
                    <div>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addSubjectModal">
                            Add Subject
                        </button>
                    </div>

                </div>
            </div>

            <table class="subjects-tbl" id="tblSubjects">
                <thead>
                    <tr>
                        <th scope="col"> Subject Code </th>
                        <th scope="col"> Desscriptive Title </th>
                        <th scope="col"> Prerequisite </th>
                        <th scope="col"> Units </th>
                        {{-- <th scope="col"> Credit Hours </th> --}}
                        <th scope="col"> Professor </th>
                        <th scope="col"> Term </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($course_subjects as $subject)
                        <tr>
                            <td>{{ $subject->subject_code }}</td>
                            <td>{{ $subject->descriptive_title }}</td>
                            <td>{{ $subject->prerequisite ?? 'N/A' }}</td>
                            <td>{{ $subject->units }}</td>
                            {{-- <td>{{ $subject->subject_code }}</td> --}}
                            <td>{{ $subject->full_name }}</td>
                            <td>{{ $subject->academicterm_id == 1 ? 'First Sem' : 'Second Sem' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <hr>
    <div class="card mb-3 shadow-sm">
        <div class="card-body">
            <div class="content-title mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>Sections</div>
                    <div>
                        <a href="{{ route('print.sections', ['code' => $course->code, 'year' => $year]) }}" target="_blank" class="btn btn-secondary">Print</a>
                    </div>

                </div>
                {{-- @dump($course) --}}
            </div>

            <table id="tblSections">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center"> Section </th>
                        <th scope="col" style="text-align: center"> Adviser </th>
                        <th scope="col" style="text-align: center"> Male </th>
                        <th scope="col" style="text-align: center"> Female </th>
                        <th scope="col" style="text-align: center"> Total Students </th>
                        <th scope="col" style="text-align: center"> Timetable </th>
                        <th scope="col" style="text-align: center"> Action </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($course_sections as $section)
                        {{-- $year  --}}
                        {{-- $course->id --}}
                        {{-- @if ($section->yearlevel_id == $year)
                            @php
                                $y_level_id = $year;
                                $course_id = $course->id;

                                $enrolled_students = DB::table('enrollmentstatus')
                                                        ->join('students','students.student_no','enrollmentstatus.student_no')
                                                        ->where([
                                                            'enrollmentstatus.status' => 'Enrolled',
                                                            'enrollmentstatus.yearlevel_id' => $y_level_id,
                                                            'enrollmentstatus.course_id' => $course_id,
                                                            'enrollmentstatus.section_id' => $section->id
                                                            ])
                                                        ->get();
                                                        // dump($enrolled_students);
                                                        // dump($section);

                                // Get the total count for each column
                                $totalCount = $enrolled_students->count('id');
                                $totalCountMale = $enrolled_students->where('gender','Male')->count();
                                $totalCountFemale = $enrolled_students->where('gender','Female')->count();
                            @endphp
                            <tr>
                                <td data-label="Section">{{ $section->section_name }}</td>
                                @foreach ($professors as $professor)
                                    @if ($professor->id === $subject->prof_id)
                                        <td data-label="Professor">{{ $professor->full_name }}</td>
                                    @endif
                                @endforeach
                                <td>{{ $totalCountMale }}</td>
                                <td>{{ $totalCountFemale }}</td>
                                <td>{{ $totalCount }}</td>
                                <td data-label="Timetable" class="view-timetable-link">
                                    <a href="{{ route('courses.info.year-level.timetable', ['code' => $course->code, 'year' => $year]) }}"
                                        data-page-title="Timetable" onclick="handleClick(this)">
                                        View Timetable
                                    </a>
                                </td>
                            </tr>
                        @endif --}}

                        {{-- @php
                            $y_level_id = $section->yearlevel_id;
                            $course_id = $section->course_id;

                            $enrolled_students = DB::table('enrollmentstatus')
                                                    ->join('students','students.student_no','enrollmentstatus.student_no')
                                                    ->where([
                                                        'enrollmentstatus.status' => 'Enrolled',
                                                        'enrollmentstatus.yearlevel_id' => $y_level_id,
                                                        'enrollmentstatus.course_id' => $course_id,
                                                        'enrollmentstatus.section_id' => $section->id
                                                        ])
                                                    ->get();
                                                    // dump($enrolled_students);
                                                    // dump($section);

                            // Get the total count for each column
                            $totalCount = $enrolled_students->count('id');
                            $totalCountMale = $enrolled_students->where('gender','Male')->count();
                            $totalCountFemale = $enrolled_students->where('gender','Female')->count();
                        @endphp
                        <tr>
                            <td>{{ $section->section_name }}</td>
                            <td>{{ $section->full_name }}</td>
                            <td>{{ $totalCountMale }}</td>
                            <td>{{ $totalCountFemale }}</td>
                            <td>{{ $totalCount }}</td>
                            <td data-label="Timetable" class="view-timetable-link">
                                <a href="{{ route('courses.info.year-level.timetable', ['code' => $course->code, 'year' => $year]) }}"
                                    data-page-title="Timetable" onclick="handleClick(this)">
                                    View Timetable
                                </a>
                            </td>
                        </tr> --}}
                        @php
                            $y_level_id = $section->yearlevel_id;
                            $course_id = $section->course_id;

                            $enrolled_students = DB::table('enrollmentstatus')
                                                    ->join('students','students.student_no','enrollmentstatus.student_no')
                                                    ->where([
                                                        'enrollmentstatus.status' => 'Enrolled',
                                                        'enrollmentstatus.yearlevel_id' => $y_level_id,
                                                        'enrollmentstatus.course_id' => $course_id,
                                                        'enrollmentstatus.section_id' => $section->id
                                                        ])
                                                    ->get();
                                                    // dump($enrolled_students);
                                                    // dump($section);

                            // Get the total count for each column
                            $totalCount = $enrolled_students->count('id');
                            $totalCountMale = $enrolled_students->where('gender','Male')->count();
                            $totalCountFemale = $enrolled_students->where('gender','Female')->count();
                        @endphp
                        <tr>
                            <td>{{ $section->section_name }}</td>
                            <td>{{ $section->full_name }}</td>
                            <td>{{ $totalCountMale }}</td>
                            <td>{{ $totalCountFemale }}</td>
                            <td>{{ $totalCount }}</td>
                            <td data-label="Timetable" class="view-timetable-link">
                                <a href="{{ route('courses.info.year-level.timetable', ['code' => $course->code, 'year' => $year]) }}"
                                    data-page-title="Timetable" onclick="handleClick(this)">
                                    View Timetable
                                </a>
                            </td>
                            <td data-label="Action" >
                                <button type="button" onclick="view_details('{{$course->code}}', '{{ $year }}', '{{ $section->section_name }}')" class="btn btn-sm btn-secondary" id="btnViewDetails">View Details</button>
                                {{-- <a href="{{ route('courses.info.year-level.details', ['code' => $course->code, 'year' => $year]) }}"
                                    data-page-title="Timetable" onclick="handleClick(this)">
                                    View More
                                </a> --}}
                            </td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="addSubjectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('subjects.store') }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $yearLevel->id }}" name="yearlevel_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Subject</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label class="form-label">Subject Code: </label>
                            <input type="text" class="form-control" name="code" placeholder="ex. Net1" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Descriptive Title: </label>
                            <input type="text" class="form-control" name="title" placeholder="ex. Networking 1" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Units: </label>
                            <input type="number" class="form-control" name="units" min="1" value="3" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Professor / Instructor: </label>
                            <div class="w-100">
                                <select name="professor" id="selectProf" class="form-control" required>
                                    @foreach (DB::table('professors')->get() as $item)
                                        <option value="{{ $item->id }}">{{ $item->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Term: </label>
                            <select name="term" id="selectProf" class="form-control"  required>
                                <option value="1">First Semester</option>
                                <option value="2">Second Semester</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('scripts')

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>

    $('#selectProf').select2({
        dropdownParent: $("#addSubjectModal"),
        placeholder: "Select or search a professor...",
        width: '100%' // need to override the changed default
    });
    $('#tblSubjects').DataTable({
        select: true,
        "lengthMenu": [10, 25, 50, 75, 100],
        "lengthChange": true,
        scrollCollapse: true,
        deferRender: true,
        scroller: true,
        ordering: false,
        initComplete: function(settings, json) {
            $('body').find('.dataTables_scrollBody').addClass("scrollbar");
        },
        "searching": true,
        autoWidth: false,
        responsive: true,
    });
    $('#tblSections').DataTable({
        select: true,
        "lengthMenu": [10, 25, 50, 75, 100],
        "lengthChange": true,
        scrollCollapse: true,
        deferRender: true,
        scroller: true,
        ordering: false,
        initComplete: function(settings, json) {
            $('body').find('.dataTables_scrollBody').addClass("scrollbar");
        },
        "searching": true,
        autoWidth: false,
        responsive: true,
    });

    popupWindow = null;
    window.currentChild = false;

    function view_details(code, year, section) {
        params = window.location.origin+`/courses/${ code }/year-level-${year}/${section}-details`;
        url = params;

        if (currentChild) currentChild.close();
        popupWindow = window.open(url,'popUpWindow','height=1200,width=1200,left=500,top=50,resizable=no,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
        currentChild = popupWindow;
    }
</script>
@endsection
