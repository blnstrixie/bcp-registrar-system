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

      <title>Grade Sheet</title>
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

          <h1>Grades</h1>

          <div class="student-info-row">
            <div class="left-side">
              <div class="group">
                <div class="label"> Student Number&#58; </div>
                <div class="data"> {{ $student->studentNum }} </div>
              </div>
    
              <div class="group">
                <div class="label"> Name&#58; </div>
                <div class="data"> {{ $student->lastname }}, {{ $student->firstname }} {{ $student->middlename }} </div>
              </div>
    
              <div class="group">
                <div class="label"> Year-Level&#58; </div>
                <div class="data"> {{ $yearLevel->year_levels }} </div>
              </div>
            </div>
    
            <div class="right-side">
              <div class="group">
                <div class="label"> Academic Year&#58; </div>
                <div class="data"> {{ $cYear->academic_year }} </div>
              </div>
    
              <div class="group">
                <div class="label"> Term&#58; </div>
                <div class="data"> {{ $cTerm->academic_term }} </div>
              </div>
    
              <div class="group">
                <div class="label"> Section&#58; </div>
                <div class="data"> Bulacan {{ $section->section_name }} </div>
              </div>
            </div>
          </div>
    
          <table>
            <thead>
              <tr>
                <th> Subject Code </th>
                <th> Descriptive Title </th>
                <th> Professor </th>
                <th> Prelim </th>
                <th> Midterm </th>
                <th> Final </th>
              </tr>
            </thead>
    
            <tbody>
              @php
                  $totalGradePoints = 0;
                  $totalCreditUnits = 0;
              @endphp
              @foreach ($cGrades as $grade)
                  @if($grade->subjects->academicterm_id === $cTerm->id)
                  <tr>
                      <td> {{ $grade->subjects->subject_code }} </td>
                      <td> {{ $grade->subjects->descriptive_title }} </td>
                      <td> {{ $grade->subjects->professors->full_name }} </td>
                      <td> {{ $grade->prelim_grade }} </td>
                      <td> {{ $grade->midterm_grade }} </td>
                      <td> {{ $grade->final_grade }} </td>
                  </tr>
                  @php
                      $gradePoints = $grade->final_grade * $grade->subjects->units;
                      $totalGradePoints += $gradePoints;
                      $totalCreditUnits += $grade->subjects->units;
                  @endphp
                  @endif
              @endforeach
            </tbody>
            <tfoot>
              @php
                  $gwa = $totalCreditUnits > 0 ? $totalGradePoints / $totalCreditUnits : 0;
              @endphp
              <tr class="gwa">
                <td colspan="1"> GWA </td>
                <td colspan="4"> &nbsp; </td>
                <td>{{ number_format($gwa, 2) }}</td>
              </tr>
            </tfoot>
          </table>
        </main>

      <script src="../../js/print.js"></script>
  </body>
</html>
