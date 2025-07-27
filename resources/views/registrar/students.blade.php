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
    <link rel="stylesheet" href="../css/overlay.css">

      <title> Students </title>
  </head>
  <body>
      @include('partials/registrar-header')
      @include('partials/registrar-sidebar')

      <main class="container">
          <div class="content-title">
              List of Students
          </div>

          <div class="search-bar" id="search-bar-students">
              <input type="text" name="search-box" id="search" placeholder="Search"/>

              <button class="search-btn">
                  <i class="fa-solid fa-magnifying-glass"></i>
              </button>
          </div>

          <a href="{{ route('studentList') }}" target="_blank">
              <button class="print-btn">
                  Print <i class="fa-solid fa-print"></i>
              </button>
          </a>

          <table>
              <thead>
                  <tr>
                      <th scope="col"> Student Number </th>
                      <th scope="col"> Name </th>
                      <th scope="col"> Course </th>
                      <th scope="col"> Year Level </th>
                      <th scope="col"> Section </th>
                      <th scope="col"> Academic Year </th>
                      <th scope="col"> Action </th>
                  </tr>
              </thead>
              <tbody id="myTable">
                @php
                    $foundResults = false;
                @endphp
                @foreach($enrollmentStatus as $studs)
                    @php
                        $foundResults = true;
                    @endphp
                    <tr>
                        <td data-label="Student Number"> {{ $studs->student->student_no }} </td>
                        <td data-label="Name">{{ $studs->student->firstname }} {{ $studs->student->middlename }} {{ $studs->student->lastname }}</td>
                        <td data-label="Course"> {{ $studs->course->program }} </td>
                        <td data-label="Year-Level"> {{ $studs->yearLevel->year_levels }} </td>
                        <td data-label="Section"> {{ $studs->section->section_name }} </td>
                        <td data-label="Academic Year"> {{ $studs->academicYear->academic_year }} </td>
                        <td data-label="Action">
                        <a href="{{ route('registrar/student-profile', ['studentNum' => $studs->student->student_no ]) }}" data-page-title="Student Information" onclick="handleClick(this)">
                                <button class="view-btn">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </a>
                        </td>
                    </tr>
                @endforeach
              </tbody>
              <tr id="noResults" style="display: {{ $foundResults ? 'none' : 'table-row' }}">
                <td colspan="7">No Results Found</td>
              </tr>
          </table>
      </main>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        </script>
      <script src="../js/selected-nav-label.js"></script>
      <script src="../js/delete-overlay.js" defer></script>
  </body>
</html>
