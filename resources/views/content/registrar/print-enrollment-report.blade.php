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

    <title> Enrollment Report </title>
  </head>

  <body>
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

      <h1> Enrollment Report <br> <small><strong>A.Y. {{ $academic_year .' - '.$academic_year+1 }}</strong></small></h1>

      <h2> Total Students Enrolled per Course </h2>

      <table class="total-enrolled-tbl">
        <thead>
            <tr>
                <th>Course</th>
                <th>Total Students</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['studentsPerCourse'] as $course)
                <tr>
                    <td>{{ $data['courses'][$course->course_id] }}</td>
                    <td>{{ $course->total_students }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Total Students Enrolled per Year-Level</h2>

    <table class="total-enrolled-tbl">
        <thead>
            <tr>
                <th>Year-Level</th>
                <th>Total Students</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['studentsPerYearLevel'] as $yearLevel)
                <tr>
                    @php
                        $originalYearLevel = $data['yearLevels'][$yearLevel->yearlevel_id];
                        $transformedYearLevel = str_replace(['1st', '2nd', '3rd', '4th'], ['First', 'Second', 'Third', 'Fourth'], $originalYearLevel);
                    @endphp
                    <td>{{ $transformedYearLevel }}</td>
                    <td>{{ $yearLevel->total_students }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Total Students Enrolled per Gender</h2>

<table class="total-enrolled-tbl">
    <thead>
        <tr>
            <th>Gender</th>
            <th>Total Students</th>
        </tr>
    </thead>
    <tbody>
            <tr>
                <td>Female</td>
                <td>{{ $data['enrolledFemale'] }}</td>
            </tr>
            <tr>
                <td>Male</td>
                <td>{{ $data['enrolledMale'] }}</td>
            </tr>
    </tbody>
</table>

    <h2>Total Students Enrolled This Academic Year</h2>
    <div class="total-enrolled-count">
        {{ $data['totalEnrollmentCount'] }}
    </div>
    </main>

    <script src="../../js/print.js"></script>
  </body>
</html>
