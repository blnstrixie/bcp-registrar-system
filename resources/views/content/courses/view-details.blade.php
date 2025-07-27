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
        #bottomTbl th,#bottomTbl td  {
            border: none;
            padding: 4px;
            background-color: white;
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
            <tr>
                <th style="font-weight: 500; width: 15%; vertical-align: top">Section: </th>
                <th>{{ $section->section_name }}</th>
            </tr>
            <tr>
                <th style="font-weight: 500; width: 15%; vertical-align: top">Adviser: </th>
                <th>{{ DB::table('professors')->where('id', $section->prof_id)->first()->full_name ?? '' }}</th>
            </tr>
        </table>

        <table>
            <thead style="background-color: white">
                <tr>
                    <th  colspan="2" style="background-color: white">LIST OF STUDENTS</th>
                </tr>
                <tr>
                    <th width="50%" style="background-color: white"> Male </th>
                    <th width="50%" style="background-color: white"> Female </th>
                </tr>
            </thead>

            @php
                $total = 0;
                $male_counter = 1;
                $female_counter = 1;
            @endphp
            <tbody>
                @php
                    $students = DB::table('enrollmentstatus')
                                  ->join('students','students.student_no','enrollmentstatus.student_no')
                                  ->where('enrollmentstatus.section_id', $section->id)->where('enrollmentstatus.year_level', $year)->where('enrollmentstatus.course_id',$course->id)
                                  ->get();
                    // dd($students->toArray());
                    $male_students = $students->where('gender','Male');
                    $female_students = $students->where('gender','Female');
                    // dd($female_students);
                @endphp
                <tr>
                    <td style="text-align: left">

                        @foreach ($male_students as $key => $item)
                            <p>{{ $key + 1 }}. {{ $item->lastname .','. $item->firstname .' '.$item->middlename }}</p>
                        @endforeach
                    </td>
                    <td style="text-align: left">
                        @foreach ($female_students as $key => $item)
                            <p>{{ $key + 1 }}. {{ $item->lastname .','. $item->firstname .' '.$item->middlename }}</p>
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>

        <table style="margin-top: 10px; border:none; border-collapse: collapse; background: white;" id="bottomTbl">
            <thead>
                <tr>
                    <th colspan="10" style="width: 90%;">
                        <div style="display: flex; justify-content: end;">
                            <div>Male:&nbsp;&nbsp;&nbsp;&nbsp;</div>
                        </div>
                    </th>
                    <th style="text-align: center">{{ $male_students->count() }}</th>
                </tr>
                <tr>
                    <th colspan="10" style="width: 90%;">
                        <div style="display: flex; justify-content: end;">
                            <div>Female:</div>
                        </div>
                    </th>
                    <th style="text-align: center">{{ $female_students->count() }}</th>
                </tr>
                <tr>
                    <th colspan="10" style="width: 90%;">
                        <div style="display: flex; justify-content: end;">
                            <div>TOTAL: &nbsp;&nbsp;</div>
                        </div>
                    </th>
                    <th style="text-align: center">{{ $students->count() }}</th>
                </tr>
            </thead>
        </table>
    </main>

    {{-- <script src="../../js/print.js"></script> --}}
    {{-- <script src="{{ asset('js/print.js') }}"></script> --}}
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
