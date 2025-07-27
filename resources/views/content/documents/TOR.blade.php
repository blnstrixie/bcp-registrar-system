<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6cbb66e0e0.js" crossorigin="anonymous"></script>
    <link rel="icon" href="../../icons/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../../icons/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../css/sheet.css">

    <title>Transcript of Records</title>
    <style>
        .tops {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="tops">
        <center>
            <button type="button" style="padding: 10px; cursor: pointer;" id="printBtn">
                <i class="fas fa-print"></i> Print
            </button>
        </center>
    </div>
    <main class="page">
        <div class="top-row">
            <img class="school-logo" src="{{ asset('images/bestlink-logo-2013.png') }}">

            <div class="school-row">
                <div class="school-name">
                    Bestlink College of the Philippines &#45; Bulacan
                </div>

                <div class="school-address">
                    San Jose Del Monte City, Bulacan
                </div>
            </div>
        </div>

        <h1> Transcript of Records </h1>

        <div class="student-info-group">
            <div class="student-info">
                <div class="left">
                    <div class="group">
                        <div class="label"> Name&#58; </div>
                        <div class="data">
                            {{ strtoupper($user->lastname) . ', ' . strtoupper($user->firstname) . ' ' . strtoupper($user->middlename) }}
                        </div>
                    </div>
                </div>

                <div class="right">
                    <div class="group">
                        <div class="label"> Student Number&#58; </div>
                        <div class="data"> {{ $user->studentNum }} </div>
                    </div>
                </div>
            </div>

            <div class="student-info">
                <div class="left">
                    <div class="group">
                        <div class="label"> Date of Birth&#58; </div>
                        <div class="data"> {{ date('F d, Y', strtotime($user->student->dob)) }}</div>
                    </div>
                </div>

                <div class="right">
                    <div class="group">
                        <div class="label"> Nationality&#58; </div>
                        <div class="data">{{ $user->student->nationality }} </div>
                    </div>
                </div>
            </div>

            <div class="student-info">
                <div class="left">
                    <div class="group">
                        <div class="label"> Address&#58; </div>
                        <div class="data"> {{ $user->student->address }} </div>
                    </div>
                </div>

                <div class="right">
                    <div class="group">
                        <div class="label"> Place of Birth&#58; </div>
                        <div class="data"> {{ $user->student->birth_place ?? 'No Data Found.' }} </div>
                    </div>
                </div>
            </div>

            <div class="student-info">
                <div class="left">
                    <div class="group">
                        <div class="label"> Degree&#58; </div>
                        <div class="data">
                            @php
                                $degree = 'N/A';
                                $student_course = DB::table('students')
                                                    ->join('enrollmentstatus','students.student_no','enrollmentstatus.student_no')
                                                    ->join('courses','enrollmentstatus.course_id','courses.id')
                                                    ->orderBy('enrollmentstatus.id','desc')
                                                    ->select('courses.program')
                                                    ->first();
                                if($student_course) {
                                    $degree = $student_course->program;
                                }
                            @endphp
                            {{ $degree }}
                        </div>
                    </div>
                </div>
            </div>

            @php
                $graduates = \App\Models\Graduate::where('student_no', $user->studentNum)->first();
                $graduated_at = '-';
                $admitted_at = '-';
                if ($graduates) {
                    $admitted_at = date('Y F d', strtotime($graduates->date_admitted));
                    $graduated_at = date('Y F d', strtotime($graduates->date_graduated));
                }
            @endphp
            <div class="student-info">
                <div class="left">
                    <div class="group">
                        <div class="label"> Date Admitted&#58; </div>
                        <div class="data">
                            {{ $admitted_at }}
                        </div>
                    </div>
                </div>

                <div class="right">
                    <div class="group">
                        <div class="label"> Date Graduated&#58; </div>
                        <div class="data">
                            {{ $graduated_at }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <table class="tor-tbl">
            <thead>
                <tr>
                    {{-- <th> Term </th> --}}
                    <th> Subject Code </th>
                    <th> Descriptive Title </th>
                    <th> Final </th>
                    {{-- <th> Completion </th> --}}
                    <th> Units </th>
                    <th> Remarks </th>
                </tr>
            </thead>
            @php
                $term = '';
                $year = '';
            @endphp
            <tbody>
                @php
                    $acad_yr = [];

                    $acad_yr = DB::table('grades')
                        ->select('term', 'acad_year')
                        ->where('student_no', $user->student->student_no)
                        ->groupBy(['term', 'acad_year'])
                        ->orderBy('term')
                        ->orderBy('acad_year')
                        ->get()
                        ->toArray();
                    // Sorting the array by 'term' and 'acad_year'
                    $sorted_acad_yr = collect($acad_yr)
                        ->sortBy([['acad_year', 'asc'], ['term', 'asc']])
                        ->values()
                        ->all();
                @endphp
                @foreach ($enrollments as $enrollment)
                    @php
                        $found = 0;
                        $term = $enrollment->term == 1 ? '1st SEMESTER' : '2nd SEMESTER';
                        $levels = ['','1st','2nd','3rd','4th'];
                        // $term = $enrollment->term == 1 ? 'FIRST SEMESTER' : 'SECOND SEMESTER';
                        // $levels = ['','FIRST','SECOND','THIRD','FOURTH'];
                    @endphp
                    <tr>
                        <td></td>
                        <td colspan="">
                            <strong> {{ $levels[$enrollment->year_level] .' YEAR ' }} ({{ $term }}) A.Y.
                                {{  $enrollment->academic_year . ' - ' . $enrollment->academic_year + 1 }}
                            </strong>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @foreach ($latestGrades as $key => $value)
                        @if ($enrollment->term == $value->term && $enrollment->academic_year == $value->acad_year)
                            @php
                                $found = 1;
                                $gwa = 'INC';
                                if ($value->prelim_grade > 0 && $value->midterm_grade > 0 && $value->final_grade > 0) {
                                    $average = ((float) $value->prelim_grade + (float) $value->midterm_grade + (float) $value->final_grade) / 3;
                                    $gwa = round($average, 2);
                                }
                            @endphp
                            <tr>
                                {{-- <td></td> --}}
                                <td>{{ $value->subjects->subject_code ?? 'Undefined' }}</td>
                                <td>{{ $value->subjects->descriptive_title ?? 'Undefined' }}</td>
                                <td>{{ $gwa }}</td>
                                {{-- <td></td> --}}
                                <td>{{ $value->subjects->units ?: 0 }}</td>
                                <td>{{ $value->remarks }}</td>
                            </tr>
                        @endif
                    @endforeach
                    @if($found == 0)
                        <tr>
                            <td></td>
                            <td>--- No Grades Record Found ---</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endif
                @endforeach

                {{-- @foreach ($cGrades as $grade)
                @if ($grade->subjects->yearlevel_id === $cYear->id || $grade->subjects->academicterm_id === $cTerm->id)
                  @php
                      $year = $cYear->academic_year;
                      $term = $cTerm->academic_term;
                  @endphp
                @endif
                <tr>
                  <td> {{ $term }}, {{ $year}} </td>
                  <td> {{ $grade->subjects->subject_code }} </td>
                  <td> {{ $grade->subjects->descriptive_title }} </td>
                  <td> {{ $grade->gwa }} </td>
                  <td>  </td>
                  <td> {{ $grade->subjects->units }} </td>
                  <td> Passed </td>
                </tr>
              @endforeach --}}
            </tbody>
        </table>
    </main>
    {{-- <script src="../../js/print.js"></script> --}}

    {{-- JQUERY --}}
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="{{ asset('js/printThis.js') }}"></script>
    <script>
        $('#printBtn').on('click', function() {
            $("main").printThis({
                canvas: true,
                header: null,
                footer: null,
            });
        })
    </script>
</body>

</html>
