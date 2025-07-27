<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6cbb66e0e0.js" crossorigin="anonymous"></script>
    <link rel="icon" href="{{ asset('icons/favicon.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('icons/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/sheet.css') }}">

    <title> Grade Report </title>
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

        <h1> Grade Report Per Year Level </h1>

        
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
                @foreach ($enrollmentStatus as $overall) 
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
                @endforeach
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
              @foreach ($enrollmentStatus as $overall) 
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
              @endforeach
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
              @foreach ($enrollmentStatus as $overall) 
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
                @endforeach
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
              @foreach ($enrollmentStatus as $overall) 
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
                @endforeach
              </tbody>                     
            </table>
    </main>

    <script src="{{ asset('js/print.js') }}"></script>
</body>

</html>
