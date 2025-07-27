<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6cbb66e0e0.js" crossorigin="anonymous"></script>
    <link rel="icon" href="../icons/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../icons/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/table.css">

    <title> Report </title>
  </head>

  <body>
    @include('partials/registrar-header')
    @include('partials/registrar-sidebar')

    <main class="container">
      <div class="content-title">
        Enrollment Report
      </div>

      <a href="{{ route('reportList') }}" target="_blank">
        <button class="print-btn" id="print-btn-course">
          Print <i class="fa-solid fa-print"></i>
        </button>
      </a>

      <div class="content-subtitle">
        <i class="fa-solid fa-chart-line"></i> Total Enrollment This 2023&#45;2024
      </div>
      <div class="total-enrolled-count">
          {{ $totalEnrollmentCount }}
      </div>

      <div class="content-subtitle">
          <i class="fa-solid fa-chart-line"></i> Total Students Enrolled per Course
      </div>
      <table class="total-enrolled-tbl">
          <thead>
              <tr>
                  <th scope="col"> Course </th>
                  <th scope="col"> Total Students </th>
              </tr>
          </thead>
          <tbody>
              @foreach($studentsPerCourse as $student)
              <tr>
                  <td data-label="Course">{{ $courses[$student->course_id] }}</td>
                  <td data-label="Total Students">

                    <a href="{{ route('registrar/students-list-course') }}">
                        {{ $student->total_students }}
                    </a>
                  </td>
              </tr>
              @endforeach
          </tbody>
      </table>

      <div class="content-subtitle">
          <i class="fa-solid fa-chart-line"></i> Total Students Enrolled per Year-Level
      </div>
      <table class="total-enrolled-tbl">
          <thead>
              <tr>
                  <th scope="col"> Year&#45;Level </th>
                  <th scope="col"> Total Students </th>
              </tr>
          </thead>
          <tbody>
              @foreach($studentsPerYearLevel as $student)
              <tr>
                  <td data-label="Year-Level">
                    @php
                        $yearLevel = $yearLevels[$student->yearlevel_id];
                        $transformedYearLevel = str_replace(['1st', '2nd', '3rd', '4th'], ['First', 'Second', 'Third', 'Fourth'], $yearLevel);
                    @endphp
                    {{ $transformedYearLevel }}
                  </td>

                <td data-label="Total Students">
                    <a href="{{ route('registrar/students-list-yearlevel') }}">
                        {{ $student->total_students }}
                    </a>
                </td>
              </tr>
              @endforeach
          </tbody>
      </table>

      <div class="content-subtitle">
          <i class="fa-solid fa-chart-line"></i> Total Students Enrolled per Gender
      </div>
      <table>
          <thead>
              <tr>
                  <th scope="col"> Gender </th>
                  <th scope="col"> Total Students </th>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td data-label="Gender"> Female </td>
                  <td data-label="Total Students">
                    <a href="{{ route('registrar/students-list-gender') }}">
                        {{ $enrolled_female }}
                    </a>
                  </td>
              </tr>
              <tr>
                  <td data-label="Gender"> Male </td>
                  <td data-label="Total Students"> {{ $enrolled_male }}</td>
              </tr>
          </tbody>
      </table>
    </main>

    <script src="../js/selected-nav-label.js"></script>
  </body>
</html>
