<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6cbb66e0e0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/sheet.css') }}">

    <title>Sections</title>

    <style>
        table#course-info th, table#course-info td  {
            border: none;
            text-align: left;
            padding: 10px;
        }
        @media print {
            .no-print, .no-print *
            {
                display: none !important;
            }
        }
    </style>
</head>

<body>

    <div class="tops no-print">
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

        <h1 style="margin-bottom: 20px;">SECTIONS</h1>

        <table id="course-info" style="margin-bottom: 15px;">
            <tr>
                <th style="font-weight: 500; width: 15%; vertical-align: top">Program: </th>
                <th>{{ strtoupper($course->program) }}</th>
            </tr>
            <tr>
                <th style="font-weight: 500; width: 15%; vertical-align: top">Description: </th>
                <th>{{ $course->description }}</th>
            </tr>
        </table>

        <table>
            <thead>
                <tr>
                    <th> Section </th>
                    <th> Adviser </th>
                    <th> Male </th>
                    <th> Female </th>
                    <th> Total </th>
                </tr>
            </thead>

            @php
                $total = 0;
            @endphp
            <tbody>
                @foreach ($sections as $section)
                    @php
                        $y_level_id = $section->yearlevel_id;
                        $course_id = $section->course_id;
                        // dump($section->id.' '.$y_level_id.' '.$course_id );
                        // dump($course_id);
                        $enrolled_students = DB::table('enrollmentstatus')
                                                ->join('students','students.student_no','enrollmentstatus.student_no')
                                                ->where([
                                                    'enrollmentstatus.status' => 'Enrolled',
                                                    'enrollmentstatus.yearlevel_id' => $y_level_id,
                                                    'enrollmentstatus.course_id' => $course_id,
                                                    'enrollmentstatus.section_id' => $section->sec_id
                                                    ])
                                                ->get();

                        // Get the total count for each column
                        $totalCount = $enrolled_students->count('id');
                        $totalCountMale = $enrolled_students->where('gender','Male')->count();
                        $totalCountFemale = $enrolled_students->where('gender','Female')->count();

                        $total += $totalCount;
                    @endphp
                    <tr>
                        <td>{{ $section->section_name }}</td>
                        <td>{{ $section->full_name }}</td>
                        <td>{{ $totalCountMale }}</td>
                        <td>{{ $totalCountFemale }}</td>
                        <td>{{ $totalCount }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr style="font-weight: 600">
                    <td colspan="4" style="text-align: right">TOTAL STUDENTS</td>
                    <td>{{ $total }}</td>
                </tr>
            </tfoot>
        </table>
    </main>

    {{-- <script src="../../js/print.js"></script> --}}
    <script src="{{ asset('js/print.js') }}"></script>
    {{-- JQUERY --}}
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="{{ asset('js/printThis.js') }}"></script>
    <script>
        $('#printBtn').on('click', function() {
            location.reload();
            return;
            clickPrint();
        })
        function clickPrint() {

            $("main").printThis({
                canvas: true,
                header: null,
                footer: null,
            });
        }
    </script>
</body>

</html>
