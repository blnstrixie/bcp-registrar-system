<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6cbb66e0e0.js" crossorigin="anonymous"></script>
    <link rel="icon" href="{{ asset('icons/favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('icons/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/general.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">

    <title> Report </title>
  </head>

  <body>
    @include('partials/registrar-header')
    @include('partials/registrar-sidebar')

    <main class="container">
      <div class="tabs">
        <!-- Overall Tab -->
        <input type="radio" name="tabs" id="tab1" checked>
        <label for="tab1"> Overall </label>

        <!-- Per Course Tab -->
        <input type="radio" name="tabs" id="tab2">
        <label for="tab2"> Per Course </label>

        <!-- Per Year Level Tab -->
        <input type="radio" name="tabs" id="tab3">
        <label for="tab3"> Per Year Level </label>

        <!-- Overall Tab Content -->
        <div class="tab-content" id="tab1-content">
          <div class="tab-content-container">
            <div class="content-title">
              Grade Report &#40;Overall&#41;
            </div>

            <div class="search-row">
              <div class="search-bar" id="search-bar-settings">
                <input type="text" name="search-box" id="search" placeholder="Search"/>

                <button class="search-btn">
                  <i class="fa-solid fa-magnifying-glass"></i>
                </button>
              </div>
            </div>

            <a href="{{ route('prints/overall-gradereport') }}" target="_blank">
              <button class="print-btn">
                Print <i class="fa-solid fa-print"></i>
              </button>
            </a>

            <table>
              <thead>
                <tr>
                  <th scope="col">Student Number</th>
                  <th scope="col">Name</th>
                  <th scope="col">Course</th>
                  <th scope="col">Year Level</th>
                  <th scope="col">Section</th>
                  <th scope="col">Final Grade</th>
                </tr>
              </thead>
              <tbody>
                {{-- @foreach ($enrollmentStatus as $overall)
                  <tr>
                      <td data-label="Student Number">{{ $overall->student_no }}</td>
                      <td data-label="Name">{{ $overall->student->firstname }} {{ $overall->student->middlename }} {{ $overall->student->lastname }} {{ $overall->student->suffix }}</td>
                      <td data-label="Course">{{ $overall->course->program }}</td>
                      <td data-label="Year Level">{{ $overall->yearLevel->year_levels }}</td>
                      <td data-label="Section">Bulacan{{ $overall->section->section_name }}</td>
                      <td data-label="Final">{{ $overall->grades->final_grade }}</td>
                  </tr>
                @endforeach --}}
              </tbody>
            </table>
          </div>
        </div>

        <!-- Per Course Content -->
        <div class="tab-content" id="tab2-content">
          <div class="content-title">
            Grade Report &#40;Per Course&#41;
          </div>

          <a href="{{ route('prints/percourse-gradereport') }}" target="_blank">
            <button class="print-btn">
              Print <i class="fa-solid fa-print"></i>
            </button>
          </a>

          <div class="content-subtitle class-margin-top">
            <i class="fa-solid fa-graduation-cap"></i> Bachelor of Science in Information Systems
          </div>

          <table>
              <thead>
                <tr>
                  <th scope="col">Student Number</th>
                  <th scope="col">Name</th>
                  <th scope="col">Course</th>
                  <th scope="col">Year Level</th>
                  <th scope="col">Section</th>
                  <th scope="col">Final Grade</th>
                </tr>
              </thead>
              <tbody>
                {{-- @foreach ($enrollmentStatus as $overall)
                  @if($overall->course->program === 'Bachelor of Science in Information Systems')
                    <tr>
                        <td data-label="Student Number">{{ $overall->student_no }}</td>
                        <td data-label="Name">{{ $overall->student->firstname }} {{ $overall->student->middlename }} {{ $overall->student->lastname }} {{ $overall->student->suffix }}</td>
                        <td data-label="Course">{{ $overall->course->program }}</td>
                        <td data-label="Year Level">{{ $overall->yearLevel->year_levels }}</td>
                        <td data-label="Section">Bulacan{{ $overall->section->section_name }}</td>
                        <td data-label="Final">{{ $overall->grades->final_grade }}</td>
                    </tr>
                  @endif
                @endforeach --}}
              </tbody>
            </table>

            <div class="content-subtitle class-margin-top">
              <i class="fa-solid fa-graduation-cap"></i> Bachelor of Science in Criminology
            </div>

          <table>
              <thead>
                <tr>
                  <th scope="col">Student Number</th>
                  <th scope="col">Name</th>
                  <th scope="col">Course</th>
                  <th scope="col">Year Level</th>
                  <th scope="col">Section</th>
                  <th scope="col">Final Grade</th>
                </tr>
              </thead>
              <tbody>
                {{-- @foreach ($enrollmentStatus as $overall)
                  @if($overall->course->program === 'Bachelor of Science in Criminology')
                    <tr>
                        <td data-label="Student Number">{{ $overall->student_no }}</td>
                        <td data-label="Name">{{ $overall->student->firstname }} {{ $overall->student->middlename }} {{ $overall->student->lastname }} {{ $overall->student->suffix }}</td>
                        <td data-label="Course">{{ $overall->course->program }}</td>
                        <td data-label="Year Level">{{ $overall->yearLevel->year_levels }}</td>
                        <td data-label="Section">Bulacan{{ $overall->section->section_name }}</td>
                        <td data-label="Final">{{ $overall->grades->final_grade }}</td>
                    </tr>
                  @endif
                @endforeach --}}
              </tbody>
            </table>
        </div>

        <!-- Per Year Level Content -->
        <div class="tab-content" id="tab3-content">
          <div class="content-title">
            Grade Report &#40;Per Year Level&#41;
          </div>

          <a href="{{ route('prints/peryearlevel-gradereport') }}" target="_blank">
            <button class="print-btn">
              Print <i class="fa-solid fa-print"></i>
            </button>
          </a>

          <div class="content-subtitle class-margin-top">
            <i class="fa-solid fa-graduation-cap"></i> 1st Year
          </div>

          <table>
              <thead>
                <tr>
                  <th scope="col">Student Number</th>
                  <th scope="col">Name</th>
                  <th scope="col">Course</th>
                  <th scope="col">Year Level</th>
                  <th scope="col">Section</th>
                  <th scope="col">Final Grade</th>
                </tr>
              </thead>
              <tbody>
                {{-- @foreach ($enrollmentStatus as $overall)
                  @if($overall->yearLevel->year_levels === '1st Year')
                    <tr>
                        <td data-label="Student Number">{{ $overall->student_no }}</td>
                        <td data-label="Name">{{ $overall->student->firstname }} {{ $overall->student->middlename }} {{ $overall->student->lastname }} {{ $overall->student->suffix }}</td>
                        <td data-label="Course">{{ $overall->course->program }}</td>
                        <td data-label="Year Level">{{ $overall->yearLevel->year_levels }}</td>
                        <td data-label="Section">Bulacan{{ $overall->section->section_name }}</td>
                        <td data-label="Final">{{ $overall->grades->final_grade }}</td>
                    </tr>
                  @endif
                @endforeach --}}
              </tbody>
            </table>

            <div class="content-subtitle class-margin-top">
              <i class="fa-solid fa-graduation-cap"></i> 2nd Year
            </div>

          <table>
              <thead>
                <tr>
                  <th scope="col">Student Number</th>
                  <th scope="col">Name</th>
                  <th scope="col">Course</th>
                  <th scope="col">Year Level</th>
                  <th scope="col">Section</th>
                  <th scope="col">Final Grade</th>
                </tr>
              </thead>
              <tbody>
                {{-- @foreach ($enrollmentStatus as $overall)
                  @if($overall->yearLevel->year_levels === '2nd Year')
                    <tr>
                        <td data-label="Student Number">{{ $overall->student_no }}</td>
                        <td data-label="Name">{{ $overall->student->firstname }} {{ $overall->student->middlename }} {{ $overall->student->lastname }} {{ $overall->student->suffix }}</td>
                        <td data-label="Course">{{ $overall->course->program }}</td>
                        <td data-label="Year Level">{{ $overall->yearLevel->year_levels }}</td>
                        <td data-label="Section">Bulacan{{ $overall->section->section_name }}</td>
                        <td data-label="Final">{{ $overall->grades->final_grade }}</td>
                    </tr>
                  @endif
                @endforeach --}}
              </tbody>
            </table>

            <div class="content-subtitle class-margin-top">
              <i class="fa-solid fa-graduation-cap"></i> 3rd Year
            </div>

          <table>
              <thead>
                <tr>
                  <th scope="col">Student Number</th>
                  <th scope="col">Name</th>
                  <th scope="col">Course</th>
                  <th scope="col">Year Level</th>
                  <th scope="col">Section</th>
                  <th scope="col">Final Grade</th>
                </tr>
              </thead>
              <tbody>
              {{-- @foreach ($enrollmentStatus as $overall)
                  @if($overall->yearLevel->year_levels === '3rd Year')
                    <tr>
                        <td data-label="Student Number">{{ $overall->student_no }}</td>
                        <td data-label="Name">{{ $overall->student->firstname }} {{ $overall->student->middlename }} {{ $overall->student->lastname }} {{ $overall->student->suffix }}</td>
                        <td data-label="Course">{{ $overall->course->program }}</td>
                        <td data-label="Year Level">{{ $overall->yearLevel->year_levels }}</td>
                        <td data-label="Section">Bulacan{{ $overall->section->section_name }}</td>
                        <td data-label="Final">{{ $overall->grades->final_grade }}</td>
                    </tr>
                  @endif
                @endforeach --}}
              </tbody>
            </table>

            <div class="content-subtitle class-margin-top">
              <i class="fa-solid fa-graduation-cap"></i> 4th Year
            </div>

          <table>
              <thead>
                <tr>
                  <th scope="col">Student Number</th>
                  <th scope="col">Name</th>
                  <th scope="col">Course</th>
                  <th scope="col">Year Level</th>
                  <th scope="col">Section</th>
                  <th scope="col">Final Grade</th>
                </tr>
              </thead>
              <tbody>
              {{-- @foreach ($enrollmentStatus as $overall)
                  @if($overall->yearLevel->year_levels === '4th Year')
                    <tr>
                        <td data-label="Student Number">{{ $overall->student_no }}</td>
                        <td data-label="Name">{{ $overall->student->firstname }} {{ $overall->student->middlename }} {{ $overall->student->lastname }} {{ $overall->student->suffix }}</td>
                        <td data-label="Course">{{ $overall->course->program }}</td>
                        <td data-label="Year Level">{{ $overall->yearLevel->year_levels }}</td>
                        <td data-label="Section">Bulacan{{ $overall->section->section_name }}</td>
                        <td data-label="Final">{{ $overall->grades->final_grade }}</td>
                    </tr>
                  @endif
                @endforeach --}}
              </tbody>
            </table>
        </div>

      </div>
    </main>

    <script src="{{ asset('js/selected-nav-label.js') }}"></script>
  </body>
</html>
