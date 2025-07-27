<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6cbb66e0e0.js" crossorigin="anonymous"></script>
    <link rel="icon" href="icons/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="icons/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/table.css">

    <title> My Profile </title>
  </head>

  <body>
    @include('partials/student-header')
    @include('partials/student-sidebar')

    <main class="container">
      <div class="tabs">
        <!-- Enrollment Status Tab -->
        <input type="radio" name="tabs" id="tab1" checked>
        <label for="tab1"> Enrollment Status </label>

        <!-- COR Tab -->
        <input type="radio" name="tabs" id="tab2">
        <label for="tab2"> Certificate of Registration </label>
        
        <!-- Enrollment Status Content -->
        <div class="tab-content" id="tab1-content">
          <div class="tab-content-container">
            <div class="content-title">
              Current Enrollment
            </div>

            <div class="student-info">
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
                <div class="data"> {{ $year->academic_year }} </div>
              </div>

              <div class="info-group">
                <div class="label"> Term&#58; </div>
                <div class="data"> {{ $term->academic_term }} </div>
              </div>

              <div class="info-group">
                <div class="label"> Year-Level&#58; </div>
                <div class="data"> {{ $yearLevel->year_levels }}</div>
              </div>

              <div class="info-group">
                <div class="label"> College&#58; </div>
                <div class="data"> {{ $course->college }} </div>
              </div>

              <div class="info-group">
                <div class="label"> Program&#58; </div>
                <div class="data"> {{ $course->program }} </div>
              </div>

              <div class="info-group">
                <div class="label">Major: </div>
                @if($course->major !== null)
                    <div class="data">{{ $course->major }}</div>
                @else
                    <div class="data">N&#47;A</div>
                @endif
              </div>

              <div class="info-group">
                <div class="label"> Section&#58; </div>
                <div class="data"> Bulacan {{ $section->section_name }} </div>
              </div>

              <div class="info-group">
                <div class="label"> Type&#58; </div>
                <div class="data"> {{ $studentType->type }} </div>
              </div>

              <div class="info-group">
                <div class="label"> Status&#58; </div>
                <div class="data"> {{ $status->status }} </div>
              </div>

              <div class="info-group">
                <div class="label">Back Subjects: </div>
                @if(count($backSubjects) > 0)
                    <div class="data">{{ implode('&#44; ', $backSubjects) }}</div>
                @else
                    <div class="data">none</div>
                @endif
              </div>
            

              <div class="info-group">
                <div class="label"> Adviser&#58; </div>
                <div class="data"> {{ $professor->full_name }} </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Enrollment Status Content -->
        <div class="tab-content" id="tab2-content">
          <div class="tab-content-container">
            <div class="content-title">
              Certificate of Registration
            </div>

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
          </div>
        </div>
      </div>
    </main>

    <script src="js/selected-nav-label.js" ></script>
  </body>
</html>
