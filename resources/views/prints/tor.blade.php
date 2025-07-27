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

          <h1> Transcript of Records </h1>

          <div class="student-info-group">
            <div class="student-info">
              <div class="left">
                <div class="group">
                  <div class="label"> Name&#58; </div>
                  <div class="data">{{ $info->firstname }} {{ $info->middlename }} {{ $info->lastname }} {{ $info->suffix }}</div>
                </div>
              </div>

              <div class="right">
                <div class="group">
                  <div class="label"> Student Number&#58; </div>
                  <div class="data"> {{ $enrollmentStatus->student_no }} </div>
                </div>
              </div>
            </div>

            <div class="student-info">
              <div class="left">
                <div class="group">
                  <div class="label"> Date of Birth&#58; </div>
                  <div class="data"> {{ date('F d, Y', strtotime($info->dob)) }}  </div>
                </div>
              </div>

              <div class="right">
                <div class="group">
                  <div class="label"> Nationality&#58; </div>
                  <div class="data"> {{ $info->nationality }} </div>
                </div>
              </div>
            </div>

            <div class="student-info">
              <div class="left">
                <div class="group">
                  <div class="label"> Address&#58; </div>
                  <div class="data"> {{ $info->address }} </div>
                </div>
              </div>

              <div class="right">
                <div class="group">
                  <div class="label"> Place of Birth&#58; </div>
                  <div class="data"> {{ $info->address }} </div>
                </div>
              </div>
            </div>

            <div class="student-info">
              <div class="left">
                <div class="group">
                  <div class="label"> Degree&#58; </div>
                  <div class="data"> {{ $course->program }} </div>
                </div>
              </div>
            </div>

            <div class="student-info">
                <div class="left">
                  <div class="group">
                    <div class="label"> Date Admitted&#58; </div>
                    <div class="data"> {{ date('F d, Y', strtotime($student->created_at)) }} </div>
                  </div>
                </div>

                <div class="right">
                  <div class="group">
                    <div class="label"> Date Graduated&#58; </div>
                    <div class="data">  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <table class="tor-tbl">
            <thead>
              <tr>
                <th> Term </th>
                <th> Subject Code </th>
                <th> Descriptive Title </th>
                <th> Final </th>
                <th> Completion </th>
                <th> Units </th>
                <th> Remarks </th>
              </tr>
            </thead>
            @php
              $term = '';
              $year = '';
            @endphp
            <tbody>
              @foreach ($cGrades as $grade)
                @if($grade->subjects->yearlevel_id === $cYear->id || $grade->subjects->academicterm_id === $cTerm->id)
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
              @endforeach
            </tbody>
          </table>
        </main>
      <script src="../../js/print.js"></script>
  </body>
</html>
