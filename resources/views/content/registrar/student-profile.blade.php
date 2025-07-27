@extends('app')
@section('title', 'Student Profile')
@section('links')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
@endsection
@section('page-content')


    @php
        $fullname = $enrollmentStatus->student->lastname . ', ' . $enrollmentStatus->student->firstname . ' ' . $enrollmentStatus->student->middlename;
    @endphp
    <div class="tabs">
        <!-- Student Profile Tab -->
        <input type="radio" name="tabs" id="tab1" checked>
        <label for="tab1"> Student Profile </label>

        <!-- Enrollment Status Tab -->
        <input type="radio" name="tabs" id="tab2">
        <label for="tab2"> Enrollment Status </label>

        <!-- Academic Records Tab -->
        <input type="radio" name="tabs" id="tab3">
        <label for="tab3"> Academic Records </label>

        <!-- COR Tab -->
        <input type="radio" name="tabs" id="tab4">
        <label for="tab4"> COR </label>

        <!-- Requests Tab -->
        <input type="radio" name="tabs" id="tab5">
        <label for="tab5"> Requests </label>

        <!-- Document Deficiencies Tab -->
        <input type="radio" name="tabs" id="tab6">
        <label for="tab6"> Deficiencies </label>



        <!-- Student Profile Content -->
        <div class="tab-content" id="tab1-content">
            <div class="tab-content-container">
                <div class="content-title">
                    Basic Information
                </div>

                <div class="student-info">
                    <div class="info-group">
                        <div class="label"> Full Name: </div>
                        <div class="data"> {{ strtoupper($fullname) }} </div>
                    </div>

                    <div class="info-group">
                        <div class="label"> Gender&#58; </div>
                        <div class="data"> {{ $info->gender }} </div>
                    </div>

                    <div class="info-group">
                        <div class="label"> Civil Status&#58; </div>
                        <div class="data"> {{ $info->civil_status }} </div>
                    </div>

                    <div class="info-group">
                        <div class="label"> Religion&#58; </div>
                        <div class="data"> {{ $info->religion }} </div>
                    </div>

                    <div class="info-group">
                        <div class="label"> Date of Birth&#58; </div>
                        <div class="data"> {{ date('F d, Y', strtotime($info->dob)) }}</div>
                    </div>

                    {{-- @php
          $dob = \Carbon\Carbon::parse($student->dob);
          $age = $dob->diffInYears(\Carbon\Carbon::now());
          @endphp --}}

                    <div class="info-group">
                        <div class="label"> Age&#58; </div>
                        <div class="data"> {{ $info->age }} years old</div>
                    </div>

                    <div class="info-group">
                        <div class="label"> Nationality&#58; </div>
                        <div class="data"> {{ $info->nationality }} </div>
                    </div>
                </div>

                <div class="content-title">
                    Contact Information
                </div>

                <div class="student-info">
                    <div class="info-group">
                        <div class="label"> Home Address&#58; </div>
                        <div class="data"> {{ $info->address }} </div>
                    </div>

                    <div class="info-group">
                        <div class="label"> Contact Number&#58; </div>
                        <div class="data"> {{ $info->contact_no }} </div>
                    </div>

                    <div class="info-group">
                        <div class="label"> Email Address&#58; </div>
                        <div class="data"> {{ $info->email }} </div>
                    </div>
                </div>

                <div class="content-title">
                    Parent&#47;Guardian's Information
                </div>

                <div class="student-info">
                    <div class="info-group">
                        <div class="label"> Father&#58; </div>
                        <div class="data"> {{ $parentGuardian->father_name }} </div>
                    </div>

                    <div class="info-group">
                        <div class="label"> Mother&#58; </div>
                        <div class="data"> {{ $parentGuardian->mother_name }} </div>
                    </div>

                    <div class="info-group">
                        <div class="label"> Guardian&#58; </div>
                        <div class="data"> {{ $parentGuardian->guardian_name }} </div>
                    </div>

                    <div class="info-group">
                        <div class="label"> Guardian&#39;s Occupation&#58; </div>
                        <div class="data"> {{ $parentGuardian->guardian_job }} </div>
                    </div>

                    <div class="info-group">
                        <div class="label"> Guardian&#39;s Contact Number&#58; </div>
                        <div class="data"> {{ $parentGuardian->guardian_contact_no }} </div>
                    </div>

                    <div class="info-group">
                        <div class="label"> Guardian&#39;s Email Address&#58; </div>
                        <div class="data"> {{ $parentGuardian->guardian_email }} </div>
                    </div>

                    <div class="info-group">
                        <div class="label"> Guardian&#39;s Home Address&#58; </div>
                        <div class="data"> {{ $parentGuardian->guardian_address }} </div>
                    </div>
                </div>

                <div class="content-title">
                    Educational Background
                </div>

                <div class="student-info">
                    <div class="info-group">
                        <div class="label"> Primary: </div>
                        <div class="data"> {{ $educationalBg->primary_school }} </div>
                    </div>

                    <div class="info-group">
                        <div class="label"> Year Graduated&#58; </div>
                        <div class="data"> {{ $educationalBg->primary_year_graduated }} </div>
                    </div>

                    <div class="info-group">
                        <div class="label"> Secondary&#58; </div>
                        <div class="data"> {{ $educationalBg->secondary_school }} </div>
                    </div>

                    <div class="info-group">
                        <div class="label"> Year Graduated&#58; </div>
                        <div class="data"> {{ $educationalBg->secondary_year_graduated }} </div>
                    </div>

                    <div class="info-group">
                        <div class="label"> Last School Attended&#58; </div>
                        <div class="data"> {{ $educationalBg->last_school_attended }} </div>
                    </div>

                    <div class="info-group">
                        <div class="label"> Year Graduated&#58; </div>
                        <div class="data"> {{ $educationalBg->last_school_year_graduated }} </div>
                    </div>
                </div>


                <div class="content-title">
                    Student System Account
                </div>

                @php
                    $user_acc =DB::table('users')->where('studentNum', $student->studentNum)->first();
                @endphp
                @if($user_acc)
                    <div class="student-info">
                        <div class="info-group">
                            <div class="label"> Email: </div>
                            <div class="data"> {{ $user_acc->emailAdd }} </div>
                        </div>
                        <div class="info-group">
                            <div class="label"> Username: </div>
                            <div class="data"> {{ $user_acc->username }} </div>
                        </div>
                        <div class="info-group">
                            <div class="label"> Password: </div>
                            <div class="data"> {{ $user_acc->password }} </div>
                        </div>
                        <div class="info-group">
                            <div class="label"> Status: </div>
                            <div class="data"> {{ $user_acc->banned == null ? 'Active' : 'Deactivated' }} </div>
                        </div>
                    </div>
                @else
                    No User Account Found.
                @endif
            </div>
        </div>

        <!-- Enrollment Status Content -->
        <div class="tab-content" id="tab2-content">
            <div class="tab-content-container">
                <div class="content-title">
                    Current Enrollment
                </div>

                <div class="student-info">
                    <div class="info-group">
                        <div class="label"> Full Name&#58; </div>
                        <div class="data">
                            {{ strtoupper($fullname) }}
                        </div>
                    </div>

                    <div class="info-group">
                        <div class="label"> Student Number&#58; </div>
                        <div class="data">
                            {{ $enrollmentStatus->student_no }}
                        </div>
                    </div>

                    <div class="info-group">
                        <div class="label"> Registration Date&#58; </div>
                        <div class="data"> {{ date('F d, Y', strtotime($enrollmentStatus->registration_date)) }} </div>
                    </div>

                    <div class="info-group">
                        <div class="label"> Academic Year&#58; </div>
                        <div class="data"> {{ $enrollmentStatus->academic_year . ' - ' . $enrollmentStatus->academic_year+1 }} </div>
                    </div>

                    <div class="info-group">
                        <div class="label"> Term&#58; </div>
                        <div class="data"> {{ $enrollmentStatus->term == 1 ? 'First Semester' : 'Second Semester' }} </div>
                    </div>

                    <div class="info-group">
                        <div class="label"> Year-Level&#58; </div>
                        <div class="data"> {{ $enrollmentStatus->level->year_levels }}</div>
                    </div>

                    <div class="info-group">
                        <div class="label"> College&#58; </div>
                        <div class="data"> {{ $enrollmentStatus->course->college }} </div>
                    </div>

                    <div class="info-group">
                        <div class="label"> Program&#58; </div>
                        <div class="data"> {{ $enrollmentStatus->course->program }} </div>
                    </div>

                    <div class="info-group">
                        <div class="label">Major: </div>
                        @if ($course->major !== null)
                            <div class="data">{{ $course->major }}</div>
                        @else
                            <div class="data">N&#47;A</div>
                        @endif
                    </div>

                    <div class="info-group">
                        <div class="label"> Section&#58; </div>
                        <div class="data"> Bulacan {{ $enrollmentStatus->section->section_name }} </div>
                    </div>

                    <div class="info-group">
                        <div class="label"> Type&#58; </div>
                        <div class="data"> {{ $enrollmentStatus->student_type->type }} </div>
                    </div>

                    <div class="info-group">
                        <div class="label"> Status&#58; </div>
                        <div class="data"> {{ $enrollmentStatus->student_status->status }} </div>
                    </div>

                    <div class="info-group">
                        <div class="label">Back Subjects: </div>
                        @if (count($backSubjects) > 0)
                            <div class="data">{{ implode('&#44; ', $backSubjects) }}</div>
                        @else
                            <div class="data">none</div>
                        @endif
                    </div>


                    <div class="info-group">
                        <div class="label"> Adviser&#58; </div>
                        <div class="data"> {{ $enrollmentStatus->adviser->full_name }} </div>
                    </div>

                    <div class="mt-3">
                        {{-- <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#enrollmentModal">Update Enrollment Status</button> --}}
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <button type="button" class="btn btn-sm btn-success" id="updateEnrollment"><span><i class="fa-solid fa-pencil"></i></span> Update Enrollment Status</button>
                        @php
                            $graduated = DB::table('graduates')->where('student_no', $enrollmentStatus->student_no)->first();
                        @endphp
                        @if($graduated)
                            <button type="button" class="btn btn-sm btn-warning" onclick="markedStatus('nonGraduated')"><span><i class="fa-solid fa-graduation-cap"></i></span> Unmark as Graduate</button>
                            <div class="alert alert-success mt-3" role="alert">
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="alert-heading text-center"><span><i class="fa-solid fa-graduation-cap"></i></span> This student has been graduated at {{ date('F Y', strtotime($graduated->date_graduated)) }}</h4>
                                    </div>
                                </div>
                            </div>
                        @else
                            <button type="button" class="btn btn-sm btn-warning" onclick="markedStatus('graduated')"><span><i class="fa-solid fa-graduation-cap"></i></span> Mark as Graduate</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @include('content.registrar.modals.update-enrollment')

        <!-- Academic Records Content -->
        <div class="tab-content" id="tab3-content">

            <div class="content-title mb-3">
                Student Grades
            </div>
            <div class="mb-3">
                <a href="{{ route('documents.show-tor', ['id' => $student->studentNum]) }}" target="_blank" class=" btn btn-sm btn-secondary">
                    Print TOR <i class="fa-solid fa-print"></i>
                </a>
            </div>
            @foreach ($enrollment_records as $record)
                <div class="content-title mb-3">
                    <div class="col-md-12">A.Y. {{ $record->academic_year .' - '. $record->academic_year+1 }}</div>
                </div>
                <div class="tab-content-container">
                    <div class="student-info"  style="margin-bottom: 10px;">
                        <div class="info-group">
                            <div class="label"> Full Name&#58; </div>
                            <div class="data">
                                {{ strtoupper($fullname) }}
                            </div>
                        </div>

                        <div class="info-group">
                            <div class="label"> Student Number&#58; </div>
                            <div class="data"> {{ $record->student_no }} </div>
                        </div>

                        <div class="info-group">
                            <div class="label"> Academic Year&#58; </div>
                            <div class="data"> {{ $record->academic_year .' - '. $record->academic_year+1 }}  </div>
                        </div>

                        <div class="info-group">
                            <div class="label"> Year-Level&#58; </div>
                            <div class="data">  {{ DB::table('yearlevels')->where(['id' => $record->yearlevel_id,'level' => $record->year_level, 'course_id' => $record->course_id])->first()->year_levels ?? '' }} </div>
                        </div>

                        <div class="info-group">
                            <div class="label"> Term&#58; </div>
                            <div class="data">  {{ DB::table('academicterms')->where('id', $record->term)->first()->academic_term ?? '' }} </div>
                        </div>

                        <div class="info-group">
                            <div class="label"> Program&#58; </div>
                            <div class="data">  {{ DB::table('courses')->where('id', $record->course_id)->first()->program ?? '' }} </div>
                        </div>

                        <div class="info-group">
                            <div class="label"> Section&#58; </div>
                            <div class="data"> {{ DB::table('sections')->where('id', $record->section_id)->first()->section_name ?? '' }} </div>
                        </div>

                        <div class="info-group">
                            <div class="label"> Type&#58; </div>
                            <div class="data"> {{ DB::table('studenttype')->where('id', $record->type_id)->first()->type ?? '' }} </div>
                        </div>

                        <div class="info-group">
                            <div class="label"> Status&#58; </div>
                            <div class="data"> {{ DB::table('studentstatus')->where('id', $record->status_id)->first()->status ?? '' }} </div>
                        </div>

                        <div class="info-group">
                            <div class="label">Back Subjects: </div>
                            @if (count($backSubjects) > 0)
                                <div class="data">{{ implode('&#44; ', $backSubjects) }}</div>
                            @else
                                <div class="data">N/A</div>
                            @endif
                        </div>

                        <div class="info-group">
                            <div class="label"> Adviser&#58; </div>
                            <div class="data"> {{ DB::table('professors')->where('id', $record->prof_id)->first()->full_name ?? '' }} </div>
                        </div>
                    </div>
                </div>
                @php
                    // $data_grades = DB::table('grades')
                    //                 //  ->join('grades','grades.student_no','enrollmentstatus.student_no')
                    //                  ->join('subjects','subjects.id','grades.subject_id')
                    //                  ->where('grades.student_no', $enrollmentStatus->student_no)
                    //                  ->where('subjects.academicterm_id', $record->term)
                    //                  ->where('subjects.yearlevel_id', $record->yearlevel_id)
                    //                 //  ->select('grades.student_no')
                    //                 //  ->pluck('grades.student_no')
                    //                  ->toArray();
                                    //  ->get();

                $student_number = $enrollmentStatus->student_no;

                $latestGrades = \App\Models\Grades::select('id','student_no', 'subject_id')->where('student_no', $student_number)
                                      ->groupBy(['id','student_no', 'subject_id'])
                                      ->latest('created_at')
                                      ->get();

                $latestGrades = \App\Models\Grades::join('subjects','subjects.id','grades.subject_id')
                                      ->whereIn('grades.id', function($query) use($student_number) {
                                            $query->where('student_no', $student_number)->select(DB::raw('MAX(id)'))
                                            ->from('grades')
                                            ->groupBy(['student_no', 'subject_id']);
                                        })
                                      ->where('subjects.academicterm_id', $record->term)
                                      ->where('subjects.yearlevel_id', $record->yearlevel_id)
                                      ->get();
                    // dump($latestGrades);
                @endphp
                <div class="card">
                    <div class="card-body">
                        <table class="tblGrades">
                            <thead>
                                <tr>
                                    <th>Subject Code</th>
                                    <th>Descriptive Title</th>
                                    <th>Professor</th>
                                    <th>Prelim</th>
                                    <th>Midterm</th>
                                    <th>Finals</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($latestGrades as $grade)
                                    <tr>
                                        <td>{{ $grade->subject_code }}</td>
                                        <td>{{ $grade->descriptive_title }}</td>
                                        <td>{{ DB::table('professors')->where('id', $grade->prof_id)->first()->full_name ?? '' }}</td>
                                        <td>{{ $grade->prelim_grade }}</td>
                                        <td>{{ $grade->midterm_grade }}</td>
                                        <td>{{ $grade->final_grade }}</td>
                                        <td>{{ $grade->remarks }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <hr>
            @endforeach

        </div>

        <!-- COR Content !-->
        <div class="tab-content" id="tab4-content">
            <div class="tab-content-container">
                <div class="content-title">
                    Certificate of Registration
                </div>

                <a href="{{ route('printCor', ['studentNum' => $student->studentNum]) }}" target="_blank">
                    <button class="print-btn">
                        Print <i class="fa-solid fa-print"></i>
                    </button>
                </a>

                <table>
                    <thead>
                        <tr>
                            <th scope="col"> Code </th>
                            <th scope="col"> Descriptive Title </th>
                            <th scope="col"> Units </th>
                            <th scope="col"> Section </th>
                            <th scope="col"> Days </th>
                            <th scope="col"> Time </th>
                            <th scope="col"> Room </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($timetable as $item)
                            <tr>
                                <td data-label="Code"> {{ $item->subjects->subject_code }} </td>
                                <td data-label="Subject Title"> {{ $item->subjects->descriptive_title }} </td>
                                <td data-label="Units"> {{ $item->subjects->units }} </td>
                                <td data-label="Section"> {{ $item->sections->section_name }} </td>
                                <td data-label="Days"> {{ $item->day_of_week }} </td>
                                <td data-label="Time">
                                    @if ($item->time_start && $item->time_end)
                                        {{ \Carbon\Carbon::createFromTimestamp(strtotime($item->time_start))->format('H:i') }}
                                        -
                                        {{ \Carbon\Carbon::createFromTimestamp(strtotime($item->time_end))->format('H:i') }}
                                    @endif
                                </td>
                                <td data-label="Room"> {{ $item->room }} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Requests Content !-->
        <div class="tab-content" id="tab5-content">
            <div class="tab-content-container">

                <div class="content-title" id="student-requests">
                    Request&#40;s&#41;
                </div>

                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <div class="sub-title">
                            Pending
                        </div>

                        <table class="" id="tblPendingReqs">
                            <thead>
                                <th>Doc Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($matchedRequests as $request)
                                    @if ($request->status === 'Pending' && $request->studentNum === $student->studentNum)
                                        <tr>
                                            <td>{{ $request->document->document_name }}</td>
                                            <td>{{ $request->status }}</td>
                                            <td>
                                                <button class="done-btn" id=""
                                                    onclick="documentProcess(`{{ route('updatePending', ['id' => $request->id]) }}`)">
                                                    Start Processing
                                                </button>
                                                <button class="view" id="" onclick="viewDoc({{ $request->id }})">
                                                    View Details
                                                </button>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <div class="sub-title">
                            Processing
                        </div>

                        <table class="table table-striped" id="tblProcessingReqs" style="width: 100%">
                            <thead>
                                <th>Doc Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($matchedRequests as $request)
                                    @if ($request->status === 'In-Process' && $request->studentNum === $student->studentNum)
                                        <tr>
                                            <td>{{ $request->document->document_name }}</td>
                                            <td>{{ $request->status }}</td>
                                            <td>
                                                <center>
                                                    <div class="d-flex justify-content-center">
                                                        <div>
                                                            <form action="{{ route('updateProcess', ['id' => $request->id]) }}"
                                                                class="form" method="POST">
                                                                @csrf
                                                                <button class="done-btn" name="submit" type="submit">
                                                                    Done
                                                                </button>
                                                            </form>
                                                        </div>
                                                        <div>
                                                            <button class="view" id=""
                                                                onclick="viewDoc({{ $request->id }})">
                                                                View Details
                                                            </button>
                                                        </div>
                                                    </div>
                                                </center>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <div class="sub-title">
                            FINISHED
                        </div>

                        <table class="table table-striped" id="tblFinishedReqs" style="width: 100%">
                            <thead>
                                <th>Doc Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($matchedRequests as $request)
                                    @if ($request->status === 'Finished' && $request->studentNum === $student->studentNum)
                                        <tr>
                                            <td>{{ $request->document->document_name }}</td>
                                            <td>{{ $request->status }}</td>
                                            <td>

                                                <div class="d-flex justify-content-center">
                                                    {{-- <div>
                                            </div> --}}
                                                    <div>
                                                        <button class="view" id=""
                                                            onclick="viewDoc({{ $request->id }})">
                                                            View Details
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!--Document Deficiencies Content -->
        <div class="tab-content" id="tab6-content">
            <div class="tab-content-container">
                <div class="content-title">
                    Document Deficiencies
                </div>

                <form action="{{ route('storeDef') }}" class="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="student_no" value="{{ $student->studentNum }}" hidden>
                    <div class="docudef-container">
                        <div class="input-grp">
                            <div class="settings-label">
                                Document
                            </div>

                            <input type="text" name="document">
                        </div>

                        <div class="input-grp">
                            <div class="settings-label">
                                Deadline
                            </div>

                            <input type="date" name="deadline">
                        </div>

                        <button class="done-btn" type="submit">
                            Submit
                        </button>
                    </div>
                </form>

                <div class="content-title">
                    List
                </div>
                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif
                @if ($deficiencies->isNotEmpty())
                    <table>
                        <thead>
                            <th>DOCUMENT</th>
                            <th>Deadline</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($deficiencies as $deficiency)
                                <tr>
                                    <td>{{ $deficiency->document }}</td>
                                    <td>{{ $deficiency->deadline }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('destroyDef', $deficiency->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="trash-btn">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No deficiencies found for this student.</p>
                @endif

            </div>
        </div>

        @include('content.registrar.modals.request-processing')
    </div>


    @endsection

    @section('scripts')
        <script>
            $(document).ready(function() {

                // $('#tab2').prop('checked', true).trigger('change');
                // $('#tab2').prop('checked', true).trigger('change');
                @if (Session::has('saved-session-tab'))
                    $('#tab{{ Session::get('saved-session-tab') }}').prop('checked', true).trigger('change');
                @endif
                // $('#tab2').prop('checked', true).trigger('change');
            })

            function documentProcess(source) {
                $('#frmProcessRequest').attr('action', source);
                $('#processDocModal').modal('show');


            }

            function viewDoc(id) {
                $('#viewDocModal').modal('show')
                $.ajax({
                    type: 'GET',
                    url: '{{ route('request.view-doc') }}',
                    data: {
                        'id': id
                    },
                    success: function(data) {
                        $('#viewDocModal #doc_body').html(data);
                    }
                })
            }
        </script>

        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
        <script>
            $('.tblGrades').DataTable({
                "language": {
                    "emptyTable": "No inserted grades to show."
                },
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
            $('#tblPendingReqs').DataTable({
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
            })
            $('#tblProcessingReqs').DataTable({
                select: true,
                "lengthMenu": [10, 25, 50, 75, 100],
                "lengthChange": true,
            })
            $('#tblFinishedReqs').DataTable({
                select: true,
                "lengthMenu": [10, 25, 50, 75, 100],
                "lengthChange": true,
            })
        </script>
        <script>
            $('#term_id').on('change', function() {
                y_level = $('#year_level').val();
                c_id = '{{ $course->id }}';
                t_id = $(this).val();

                $('#section_id').empty();
                $.ajax({
                    type    : 'GET',
                    url     : '{{ route("fetch-section") }}',
                    data    : {'y_level' : y_level, 'c_id' : c_id,'t_id' : t_id},
                    success:function(data) {
                        console.log(data);
                        $.each(data.sections, function (k,v) {
                            console.log(v.section_name)
                            $('#section_id').append('<option value="'+v.id+'">'+v.section_name+'</option>');
                        })
                    }
                })
            })
        </script>
        {{-- SCRIPT FOR ENROLLMENT STATUS --}}
        <script>
            $('#updateEnrollment').on('click', function () {
                student_no = '{{ $enrollmentStatus->student_no }}';
                $('#updateEnrollmentModal #student_number').val(student_no)
                $('#updateEnrollmentModal').modal('show');
            })
            function markedStatus(status) {
                student_no = '{{ $enrollmentStatus->student_no }}';
                $('#graduateModal #student_number').val(student_no)
                $('#graduateModal #marked_status').val(status)
                if(status == 'graduated') {
                    $('#mark-as-graduate-status-container').show();
                    $('#unmark-as-graduate-status-container').hide();
                }
                else {
                    $('#mark-as-graduate-status-container').hide();
                    $('#unmark-as-graduate-status-container').show();
                }
                $('#graduateModal').modal('show');
            }

            $('#yearLevels').on('change', function () {
                var level = $(this).find(':selected').data('level');
                $('#student_year_level').val(level);

                $('#instructor').val('');
                $('#sections').prop({'disabled' : true});

                $('#sections').empty();

                var year_level = $(this).val() ?? 0;
                var course_id = $('#student_course_id').val();

                $.ajax({
                    type : 'GET',
                    url  : '{{ route("student.get-section") }}',
                    data : { 'year_level' : year_level, 'course_id' : course_id },
                    success: function (data) {
                        $('#sections').append('<option value="" hidden selected>Please select section...</option>')
                        $.each(data, function (k, v) {
                            $('#sections').append('<option value="'+v.id+'" data-prof="'+v.full_name+'" data-prof-id="'+v.prof_id+'">'+v.section_name+'</option>')
                        })
                        $('#sections').prop({'disabled' : false});
                    }
                })
            })
            $('#sections').on('change', function () {
                var data_prof = $(this).find(':selected').data('prof');
                var data_prof_id = $(this).find(':selected').data('prof-id');

                $('#instructor').val(data_prof);
                $('#student_prof_id').val(data_prof_id);
            })
        </script>
    @endsection
