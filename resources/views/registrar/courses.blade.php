<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6cbb66e0e0.js" crossorigin="anonymous"></script>
    <link rel="icon" href="../icons/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../icons/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/grid-cards.css">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/style.css">

    <title> Courses </title>
  </head>

  <body>
    @include('partials/registrar-header')
    @include('partials/registrar-sidebar')

    <main class="container">
      <div class="content-title">
        List of Courses
      </div>

      <div class="search-bar">
        <input type="text" name="search-box" id="search" placeholder="Search"/>

        <button class="search-btn">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
      </div>

      <div class="filter-row">
        <div class="filter-label">
          Filter
        </div>

        <div class="select-group">
          <select name="course" id="course">
            <option selected disabled> Course </option>
            @php $value = 1 @endphp
            @foreach($courses as $program)
                <option value="{{ $value }}">{{ $program }}</option>
                @php $value++ @endphp
            @endforeach
          </select>

          <select name="year-level" id="year-level" hidden>
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

          <button id="filterButton" class="filter-btn">
            <i class="fa-solid fa-filter"></i>
          </button>
        </div>
      </div>

        <div class="cards-container">
          @foreach ($course as $course)
            <a href="{{ route('courseInfo', ['id' => $course->id]) }}" data-page-title="{{ $course->program }}" onclick="handleClick(this)">
                <div class="card" id="card-course">
                    <div class="card-stats">
                        <p class="course-label">
                            {{ $course->program }}
                        </p>

                        <div class="course-stats">
                            <i class="fa-solid fa-graduation-cap"></i>

                            <p class="card-label">
                                {{ $course->enrollment_statuses_count }}
                            </p>
                        </div>
                    </div>
                </div>
            </a>
          @endforeach
        </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function() {
        $("#search").on("keyup", function() {
          var value = $(this).val().toLowerCase();
          var found = false;
          
          $(".cards-container a").each(function() {
            var currentText = $(this).text().toLowerCase();
            var match = currentText.indexOf(value) > -1;
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

          $(".cards-container a").each(function() {
            var rowCourse = $(this).find(".course-label").text().trim();

            var courseMatch = (courseValue === 'Course' || rowCourse === courseValue);

            var overallMatch = courseMatch;

            $(this).toggle(overallMatch);
          });
        });
      });
    </script>

    <script src="../js/selected-nav-label.js"></script>
  </body>
</html>