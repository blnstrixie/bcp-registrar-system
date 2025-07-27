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

    <!-- Latest compiled and minified CSS --><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title> Grades </title>
  </head>

  <body>
    @include('partials/registrar-header')
    @include('partials/registrar-sidebar')

    <main class="container">
        <div class="d-flex justify-content-between">
            <div>
                <h3>
                    Viewing of Grades
                </h3>
            </div>
            <div>
                <a href="{{ route('grades-import-view') }}" type="button" class="btn btn-success">Import Grades</a>
            </div>
        </div>

      {{-- <div class="search-bar">
        <input type="text" name="search" id="search" placeholder="Search"/>

        <button class="search-btn">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
      </div>

      <div class="filter-row">
        <div class="filter-label">
          Filter
        </div>

        <div id="dataDisplay" class="select-group">
          <select name="course" id="course">
            <option selected disabled> Course </option>
            @php $value = 1 @endphp
            @foreach($courses as $program)
                <option value="{{ $value }}">{{ $program }}</option>
                @php $value++ @endphp
            @endforeach
          </select>

          <select name="year-level" id="year-level">
            <option selected disabled> Year Level </option>
            @php $value = 1 @endphp
            @foreach($yearLevels as $years)
                @php
                    $transformedYearLevel = str_replace(['1st', '2nd', '3rd', '4th'], ['First', 'Second', 'Third', 'Fourth'], $years);
                @endphp
                <option value="{{ $value }}">{{ $transformedYearLevel }}</option>
                @php $value++ @endphp
            @endforeach
          </select>

          <select name="section" id="section" hidden>
            <option selected disabled> Section </option>
            @php $value = 1 @endphp
            @foreach($sections as $sec)
                <option value="{{ $value }}">Bulacan {{ $sec }}</option>
                @php $value++ @endphp
            @endforeach
          </select>

          <select name="subject" id="subject">
            <option selected disabled> Subject </option>
            @php $value = 1 @endphp
            @foreach($subjects as $subj)
                <option value="{{ $value }}">{{ $subj->descriptive_title }}</option>
                @php $value++ @endphp
            @endforeach
          </select>

          <button id="filterButton" class="filter-btn">
            <i class="fa-solid fa-filter"></i>
          </button>
        </div>
      </div> --}}

      <table>
        <thead>
          <tr>
            <th hidden>Course</th>
            <th hidden>Year Level</th>
            <th>Student Number</th>
            <th>Section</th>
            <th hidden>Subject</th>
            <th scope="col"> Subject Code </th>
            <th scope="col"> Descriptive Title </th>
            <th scope="col"> Prelim Grade </th>
            <th scope="col"> Midterm Grade </th>
            <th scope="col"> Final Grade </th>
            <th scope="col"> Remarks </th>
            <th scope="col"> Professor </th>
          </tr>
        </thead>
        <tbody id="myTable">
          @php
              $foundResults = false;
          @endphp
          @foreach($subjects as $subjectsProf)
            @php
                $foundResults = true;
            @endphp
            <tr>
              <td data-column="course" hidden>{{ $subjectsProf->section->yearLevel->course->program }}</td>
              @php
                  $transformedYearLevel = str_replace(['1st', '2nd', '3rd', '4th'], ['First', 'Second', 'Third', 'Fourth'], $subjectsProf->section->yearLevel->year_levels);
              @endphp
              <td data-column="year-level" hidden>{{ $transformedYearLevel }}</td>
              <td data-column="student-number">{{ $subjectsProf->grades->student_no }}</td>
              <td data-column="section">Bulacan {{ $subjectsProf->section->section_name }}</td>
              <td data-column="subject" hidden>{{ $subjectsProf->descriptive_title }}</td>
              <td data-label="Subject Code"> {{ $subjectsProf->subject_code }} </td>
              <td data-label="Descriptive Title"> {{ $subjectsProf->descriptive_title }} </td>
              <td data-label="Final Grade"> {{ $subjectsProf->grades->final_grade }} </td>
              <td data-label="Final Grade"> {{ $subjectsProf->grades->final_grade }} </td>
              <td data-label="Final Grade"> {{ $subjectsProf->grades->final_grade }} </td>
              <td data-label="Professor"> {{ $subjectsProf->professors->full_name }} </td>
              <td data-label="Professor"> {{ $subjectsProf->professors->full_name }} </td>
            </tr>
          @endforeach
        </tbody>
        <tr id="noResults" style="display: {{ $foundResults ? 'none' : 'table-row' }}">
          <td colspan="5">No Results Found</td>
        </tr>
      </table>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
      $(document).ready(function() {
          $("#search").on("keyup", function() {
              var value = $(this).val().toLowerCase();
              var found = false;
              $("#myTable tr").filter(function() {
                  var currentRow = $(this).text().toLowerCase();
                  var match = currentRow.indexOf(value) > -1;
                  $(this).toggle(match);
                  if (match) {
                      found = true;
                  }
              });
              $("#noResults").toggle(!found);
          });
      });
      $(document).ready(function() {
        $("#filterButton").on("click", function() {
          var courseValue = $("#course option:selected").text();
          var yearLevelValue = $("#year-level option:selected").text();
          var subjectValue = $("#subject option:selected").text();

          $("#myTable tr").each(function() {
            var rowCourse = $(this).find("td[data-column='course']").text();
            var rowYearLevel = $(this).find("td[data-column='year-level']").text();
            var rowSubject = $(this).find("td[data-column='subject']").text();

            var courseMatch = (courseValue === '0' || rowCourse === courseValue);
            var yearLevelMatch = (yearLevelValue === '0' || rowYearLevel === yearLevelValue);
            var subjectMatch = (subjectValue === '0' || rowSubject === subjectValue);

            if (courseMatch && yearLevelMatch && subjectMatch) {
                $(this).show();
            } else {
                $(this).hide();
            }
          });
        });
      });
    </script>
    <script src="../js/selected-nav-label.js"></script>
  </body>
</html>
