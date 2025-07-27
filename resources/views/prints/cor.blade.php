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

    <title> Certificate of Registration </title>
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

      <h1> Certificate of Registration </h1>

      <div class="student-info-row">
        <div class="left">
          <div class="group">
            <div class="label"> Student Number&#58; </div>
            <div class="data"> {{ $student->studentNum }} </div>
          </div>

          <div class="group">
            <div class="label"> Registration Date&#58; </div>
            <div class="data"> {{ date('F d, Y', strtotime($student->created_at)) }} </div>
          </div>

          <div class="group">
            <div class="label"> Student Name&#58; </div>
            <div class="data"> {{ $info->firstname }} {{ $info->middlename }} {{ $info->lastname }} {{ $info->suffix }} </div>
          </div>

          <div class="group">
            <div class="label"> Year Level&#58; </div>
            <div class="data"> {{ $yearLevel->year_levels }} </div>
          </div>
        </div>

        <div class="right">
          <div class="group">
            <div class="label"> Academic Year&#58; </div>
            <div class="data"> {{ $cYear->academic_year }}&#44; {{ $cTerm->academic_term }} </div>
          </div>

          <div class="group">
            <div class="label"> College&#58; </div>
            <div class="data"> {{ $course->college }} </div>
          </div>

          <div class="group">
            <div class="label"> Major&#58; </div>
            <div class="data"> {{ $course->major }}  </div>
          </div>

          <div class="group">
            <div class="label"> Program&#58; </div>
            <div class="data"> {{ $course->program }}  </div>
          </div>
        </div>
      </div>

      <table>
        <thead>
          <tr>
            <th> Code </th>
            <th> Descriptive Title </th>
            <th> Credits </th>
            <th> Section </th>
            <th> Days </th>
            <th> Time </th>
            <th> Room </th>
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
                    @if($item->time_start && $item->time_end)
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
      @php
          $totalSubjects = 0;
          $totalUnits = 0;
      @endphp

      @foreach ($timetable as $item)
          @php
              $totalSubjects++;
              $totalUnits += $item->subjects->units;
          @endphp
          <!-- Your existing table display code here -->
      @endforeach
      <div class="bottom-row">
        <div class="total-group">
          <div class="total-label"> Total Subjects </div>
          <div class="total-data"> {{ $totalSubjects }} </div>
        </div>

        <div class="total-group">
          <div class="total-label"> Total Units </div>
          <div class="total-data"> {{ $totalUnits }} </div>
        </div>
      </div>
    </main>

    <script src="../../js/print.js"></script>
  </body>
</html>