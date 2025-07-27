@extends('app')
@section('title', 'Grades')

@section('links')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('page-content')

    <div class="d-flex justify-content-between">
        <div>
            <h3>
                List of Students Grades
            </h3>
        </div>
        @if(Auth::user()->role == 'Teacher')
            <div class="d-flex justify-content-between gap-2">
                <div>
                    <button id="addGrade" class="btn btn-success">Add Student Grade</button>
                </div>
                <div>
                    <a href="{{ route('grades-import-view') }}" type="button" class="btn btn-success">Import Grades</a>
                </div>
            </div>
        @endif
    </div>
    <div class="card mt-3">
        <div class="card-body">
            <div class="table-responsive">
                <table id="gradesTable" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Student No.</th>
                            <th>Name</th>
                            <th>Section</th>
                            <th>Subject Code</th>
                            <th>Descriptive Title</th>
                            <th>Prelim</th>
                            <th>Midterm</th>
                            <th>Final</th>
                            <th>Remarks</th>
                            <th>Professor</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL --}}
    <!-- ADD GRADE Modal -->
    <div class="modal fade" id="addGradeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" >
            <div class="modal-content">
                <form action="{{ route('grades.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">ADD STUDENT GRADE</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Last Name:</label>
                                        <input type="text" class="form-control" id="lname" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>First Name:</label>
                                        <input type="text" class="form-control" id="fname" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Middle Name:</label>
                                        <input type="text" class="form-control" id="mname" readonly>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="form-group mb-2">
                                <label>Student Number:</label>
                                <select class="form-control form-select" style="width: 100%" id="selectStudentNo" name="student_number">
                                    <option value="" selected hidden>Select Student Number...</option>
                                    @foreach(\App\Models\EnrollmentStatus::where('status','enrolled')->get() as $key => $value)
                                        <option value="{{ $value->student_no }}">{{ $value->student_no }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="subject-grade-container" style="display: none">
                                <div class="form-group mb-2">
                                    <label>Subject Code:</label>
                                    <select class="form-control form-select" style="width: 100%" id="subject_code" name="subject_id">
                                        <option value="" selected hidden>Select Subject Code...</option>
                                        @foreach(\App\Models\Subjects::get() as $key => $value)
                                            <option value="{{ $value->id }}">{{ $value->subject_code }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Prelim:</label>
                                            <input type="text" class="form-control" id="prelim_grade" name="prelim_grade" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Midterm:</label>
                                            <input type="text" class="form-control" id="midterm_grade" name="midterm_grade" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Final:</label>
                                            <input type="text" class="form-control" id="final_grade" name="final_grade" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>A.Y.:</label>
                                            <input type="number" class="form-control" id="acad_year" name="acad_year" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Remarks:</label>
                                    <input type="text" name="remarks" id="remarks" class="form-control">
                                </div>
                            </div> --}}
                            <div class="form-group mb-2">
                                <label>Year Level:</label>
                                <select class="form-control form-select" style="width: 100%" id="selectYearLevel" name="year_level" required>
                                    <option value="" selected hidden>Select Year Level...</option>
                                    <option value="1">1st Year</option>
                                    <option value="2">2nd Year</option>
                                    <option value="3">3rd Year</option>
                                    <option value="4">4th Year</option>
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label>Term:</label>
                                <select class="form-control form-select" style="width: 100%" id="acad_term" name="acad_term" required>
                                    <option value="1">First Semester</option>
                                    <option value="2">Second Semester</option>
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label>Course:</label>
                                <select class="form-control form-select" style="width: 100%" id="selectCourse" name="course" required>
                                    <option value="0" selected hidden>Select Course...</option>
                                    @foreach (DB::table('courses')->get() as $item)
                                        <option value="{{ $item->id }}">{{ $item->program }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label>Student No:</label>
                                <select class="form-control form-select" style="width: 100%" id="selectStudentNumber" name="student_number" required>
                                </select>
                            </div>
                            <div id="subject_container" style="display: none;">
                                <div class="form-group mb-2">
                                    <label>Subject:</label>
                                    <select class="form-control form-select" style="width: 100%" id="selectCodes" name="subject_id" required>
                                    </select>
                                </div>
                            </div>
                            <div id="grades_container" style="display: none;">
                                <div class="row mb-2">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Prelim:</label>
                                            <input type="text" class="form-control" id="prelim_grade" name="prelim_grade" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Midterm:</label>
                                            <input type="text" class="form-control" id="midterm_grade" name="midterm_grade" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Final:</label>
                                            <input type="text" class="form-control" id="final_grade" name="final_grade" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>A.Y.:</label>
                                            <input type="number" class="form-control" id="acad_year" name="acad_year" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Remarks:</label>
                                    <input type="text" name="remarks" id="remarks" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
    $(document).ready(function () {
        gradesTable();
        $('#selectStudentNo').select2({
                dropdownParent: $(".modal"),
                placeholder: "Select or search a student number",
            });
        $('#subject_code').select2({
                dropdownParent: $("#subject-grade-container"),
                placeholder: "Select or search a subject code",
            });
    });

    function gradesTable() {
        $('#gradesTable').DataTable({
            select: true,
            "lengthMenu": [10, 25, 50, 75, 100 ],
            "lengthChange": true,
            scrollX: true,
            scrollCollapse: true,
            deferRender:    true,
            scroller:       true,
            initComplete: function (settings, json) {
                $('body').find('.dataTables_scrollBody').addClass("scrollbar");
            },
            "searching": true,
            "info":false,
            // responsive: true,
            serverSide:true,
            processing: true,
            ajax:'',
            columns:[
                {'data':'stud_no'},
                {'data':'stud_name'},
                {'data':'section'},
                {'data':'subject_code'},
                {'data':'desc_title'},
                {'data':'prelim'},
                {'data':'midterm'},
                {'data':'final'},
                {'data':'remarks'},
                {'data':'prof'}
            ]
        });
    }

    $('#addGrade').on('click', function () {
        $('#addGradeModal').modal('show');
    })
    $('#selectStudentNo').on('change', function () {
        $('#subject-grade-container').show();
        var student_no = $(this).val();
        $.ajax({
            type: 'GET',
            url : '{{ route("grades.fetch-student") }}',
            data: {'student_no' : student_no},
            success:function (data) {
                if(data) {
                    $('#lname').val(data.lastname)
                    $('#fname').val(data.firstname)
                    $('#mname').val(data.middlename)
                }
            }
        })
    });
    $('#subject_code').on('change', function () {
        var subject_id = $(this).val();
        var student_no = $('#selectStudentNo').val();

        $.ajax({
            type : 'GET',
            url : '{{ route('grades.fetch-grade') }}',
            data: {'subj_id' : subject_id, 's_no' : student_no},
            success:function (data) {
                $('#prelim_grade').val(data.prelim)
                $('#midterm_grade').val(data.midterm)
                $('#final_grade').val(data.final)
                $('#acad_year').val(data.acad_year)
            }
        })
    })
</script>
{{-- New FIELDS --}}
<script>
    $('#selectYearLevel').on('change', function () {
        getStudentsNo();
    })
    $('#acad_term').on('change', function () {
        getStudentsNo();
    })
    $('#selectCourse').on('change', function () {
        getStudentsNo();
    })
    function getStudentsNo() {
        var year_level_id = $('#selectYearLevel').val() ?? 0;
        var acad_term = $('#acad_term').val() ?? 0;
        var course_id = $('#selectCourse').val() ?? 0;

        $('#grades_container').hide();

        $('#subject_container').hide();

        // $('#selectStudentNumber').empty();
        $.ajax({
            type : 'GET',
            url  : '{{ route("get.students-no") }}',
            data : { 'year_level' : year_level_id, 'course_id' : course_id, 'acad_term' : acad_term },
            success: function (response) {
                $('#selectStudentNumber').empty();
                $('#selectStudentNumber').append('<option></option>')
                $.each(response, function(index, data) {
                    $('#selectStudentNumber').append('<option value="'+data.student_no+'" data-fname="'+data.firstname+'" data-lname="'+data.lastname+'" data-mname="'+data.middlename+'">'+data.student_no+'</option>')
                })
            }
        })

        $('#selectStudentNumber').select2({
            dropdownParent: $(".modal"),
            placeholder: "Select or search a student number",
            language: {
                noResults: function() {
                    return 'No enrolled student from the selected fields.<br>Contact registrar to enroll student.';
                },
            },
            escapeMarkup: function(markup) {
                return markup;
            },
        });
    }
    $('#selectStudentNumber').on('change', function () {
        // getStudentSubject
        $('#subject_container').show();

        $('#grades_container').hide();

        fname = $(this).find(':selected').data("fname");
        lname = $(this).find(':selected').data("lname");
        mname = $(this).find(':selected').data("mname");


        $('input#lname').val(lname);
        $('input#fname').val(fname);
        $('input#mname').val(mname);

        var year_level_id = $('#selectYearLevel').val() ?? 0;
        var acad_term = $('#acad_term').val() ?? 0;
        var course_id = $('#selectCourse').val() ?? 0;


        $('#selectCodes').prop({'disabled':true});

        $.ajax({
            type : 'GET',
            url  : '{{ route("get.student-subject") }}',
            data : { 'year_level' : year_level_id, 'course_id' : course_id, 'acad_term' : acad_term },
            success : function (data) {
                $('#prelim_grade').val(0);
                $('#midterm_grade').val(0);
                $('#final_grade').val(0);
                $('#acad_year').val(0);
                $('#selectCodes').empty();
                $('#selectCodes').append('<option></option>')
                $.each(data, function(index, data) {
                    $('#selectCodes').append('<option value="'+data.id+'">'+data.subject_code+'</option>')
                })

                $('#selectCodes').prop({'disabled':false});
            }
        })
        $('#selectCodes').select2({
            dropdownParent: $("#subject_container"),
            placeholder: "Select or search a student number",
        });
    })

    $('#selectCodes').on('change', function () {
        var subject_id = $(this).find(':selected').val();
        var student_no = $('#selectStudentNumber').val();

        $('#grades_container').show();
        $.ajax({
            type : 'GET',
            url : '{{ route('grades.fetch-grade') }}',
            data: {'subj_id' : subject_id, 's_no' : student_no},
            success:function (data) {
                $('#prelim_grade').val(data.prelim)
                $('#midterm_grade').val(data.midterm)
                $('#final_grade').val(data.final)
                $('#remarks').val(data.remarks)
                $('#acad_year').val(data.acad_year)
            }
        })
    })
</script>
@endsection
