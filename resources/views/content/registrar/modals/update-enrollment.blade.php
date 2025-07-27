<div class="modal fade" id="enrollmentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Enrollment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form>
                        <input type="hidden" value="{{ $enrollmentStatus->student_no }}" name="student_no">
                        <input type="hidden" value="{{ $course->id }}" name="course_id">
                        <div class="form-group mb-3">
                            <label for="exampleInputEmail1">Academic Year:</label>
                            <input type="number" class="form-control" name="academic_year" min="2000"
                                max="{{ now()->format('Y') }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="exampleInputEmail1">Registration Date:</label>
                            <input type="date" class="form-control" name="registration_date" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="exampleInputPassword1">Year Level</label>
                            <select name="year_level" id="year_level" required class="form-control">
                                <option value="">Select Year Level</option>
                                @foreach (\App\Models\YearLevels::where('course_id', $course->id)->get() as $key => $value)
                                    <option value="{{ $value->id }}">{{ $value->year_levels }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label>Term</label>
                            <select name="term_id" id="term_id" required class="form-control">
                                <option value="0">Select academic term</option>
                                <option value="1">First Semester</option>
                                <option value="2">Second Semester</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="exampleInputPassword1">Section</label>
                            <select name="section_id" id="section_id" required class="form-control">
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label>Student Type</label>
                            <select name="student_type" id="student_type" required class="form-control">
                                @foreach (DB::table('studenttype')->get() as $value)
                                    <option value="{{ $value->id }}">{{ $value->type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label>Student Status</label>
                            <select name="student_status" id="student_status" required class="form-control">
                                @foreach (DB::table('studentstatus')->get() as $value)
                                    <option value="{{ $value->id }}">{{ $value->status }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- UPDATE ENROLLMENT STATUS Modal -->
<div class="modal fade" id="updateEnrollmentModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('student.save-enrollment') }}" method="POST">
                @csrf
                <input type="hidden" name="student_number" id="student_number">
                <input type="hidden" value="{{ $course->id }}" id="student_course_id" name="course_id">
                <input type="hidden" value="" id="student_prof_id" name="prof_id">
                <input type="hidden" value="" id="student_year_level" name="level">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Enrollment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <label class="mb-3 form-label">
                            Student No: <strong>{{ $enrollmentStatus->student_no }}</strong>
                        </label>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Registration Date: </label>
                            <input type="date" class="form-control" required name="date_registered" value="{{ now()->format('Y-m-d') }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Academic Year: </label>
                            <input type="number" min="2002" max="2099" step="1" value="{{ now()->format('Y') }}" required name="academic_year" class="form-control"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Student Type: </label>
                            <select class="form-control" name="student_type" id="" required>
                                @foreach (DB::table('studenttype')->get() as $item)
                                    <option value="{{ $item->id }}">{{ $item->type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Student Status: </label>
                            <select class="form-control" name="student_status" id="" required>
                                @foreach (DB::table('studentstatus')->get() as $item)
                                    <option value="{{ $item->id }}">{{ $item->status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Year Level: </label>
                            <select class="form-control" name="yearlevel_id" id="yearLevels" required>
                                <option value="" hidden selected>Select year level...</option>
                                @foreach (DB::table('yearlevels')->where('course_id', $course->id)->get() as $item)
                                    <option value="{{ $item->id }}" data-level="{{ $item->level }}">{{ $item->year_levels }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Term: </label>
                            <select class="form-control" name="term"  required>
                                {{-- <option value="" hidden selected>Please select year level...</option> --}}
                                <option value="1">1st Semester</option>
                                <option value="2">2nd Semester</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Course: </label>
                            <input type="text" value="{{ $course->program }}" class="form-control" disabled readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Section: </label>
                            <select class="form-control" name="section" id="sections" required disabled>
                                <option value="">Select section...</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Professor / Instructor: </label>
                            <input type="text" value="" id="instructor" class="form-control" disabled readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- MARK AS GRADUATE Modal -->
<div class="modal fade" id="graduateModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('student.marked-graduated') }}" method="POST">
                @csrf
                <input type="hidden" name="student_number" id="student_number">
                <input type="hidden" name="marked_status" id="marked_status">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Graduated Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="unmark-as-graduate-status-container" style="display: none">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <h3 class="text-center"><strong>This graduated student is about to be unmarked.</strong> </h3>
                            </div>
                        </div>
                    </div>
                    <div id="mark-as-graduate-status-container" style="display: none">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Date Admitted: </label>
                                <input type="date" class="form-control" name="date_admitted">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Academic Year: </label>
                                <input type="date" class="form-control" name="date_graduated">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
