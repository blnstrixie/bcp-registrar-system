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

      <title> Student Lists </title>
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

      <h1> Student Lists </h1>

      <table>
          <thead>
          <tr>
              <th scope="col"> Student Number </th>
              <th scope="col"> Name </th>
              <th scope="col"> Course </th>
              <th scope="col"> Year Level </th>
              <th scope="col"> Section </th>
              <th scope="col"> Academic Year </th>
          </tr>
          </thead>
          <tbody>
            @foreach($students as $student)
                <tr>
                    <td data-label="Student Number">{{ $student->student_no }}</td>
                    <td data-label="Name">{{ $student->firstname }} {{ $student->middlename }} {{ $student->lastname }} {{ $student->suffix }}</td>
                    @if($student->enrollmentStatus) <!-- Check if enrollmentStatus is available -->
                        <td data-label="Course">{{ $student->enrollmentStatus->course->program }}</td>
                        <td data-label="Year-Level">{{ $student->enrollmentStatus->yearLevel->year_levels }}</td>
                        <td data-label="Section">{{ $student->enrollmentStatus->section->section_name }}</td>
                        <td data-label="Academic Year">{{ $student->enrollmentStatus->academicYear->academic_year }}</td>
                    @endif
                </tr>
            @endforeach
        
          </tbody>
      </table>

      <div class="bottom-row">
          <div class="total-group">
              <div class="total-label"> Total Students </div>
              <div class="total-data"> {{ $students->count() }}  </div>
          </div>
      </div>
  </main>

  <script src="../../js/print.js"></script>
  </body>
</html>
