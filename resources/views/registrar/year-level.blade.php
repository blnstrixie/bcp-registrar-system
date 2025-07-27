<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6cbb66e0e0.js" crossorigin="anonymous"></script>
    <link rel="icon" href="../../icons/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../../icons/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/sidebar.css">
    <link rel="stylesheet" href="../../css/general.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/table.css">

    <title> Subjects and Sections </title>
  </head>

  <body>
    @include('partials/registrar-header')
    @include('partials/registrar-sidebar')

    <main class="container">
      <div class="content-title">
        Subjects
      </div>

      <table class="subjects-tbl">
        <thead>
          <tr>
          <th scope="col"> Subject Code </th>
            <th scope="col"> Desscriptive Title </th>
            <th scope="col"> Prerequisite </th>
            <th scope="col"> Units </th>
            <th scope="col"> Credit Hours </th>
            <th scope="col"> Professor </th>
            <th scope="col"> Term </th>
          </tr>
        </thead>
        <tbody>
          @foreach($subjects as $subject)
                @if($subject->yearlevel_id == $year)
                    <tr>
                        <td data-label="Subject Code">{{ $subject->subject_code }}</td>
                        <td data-label="Descriptive Title">{{ $subject->descriptive_title }}</td>
                        <td data-label="Prerequisite">{{ $subject->prerequisite }}</td>
                        <td data-label="Units">{{ $subject->units }}</td>
                        <td data-label="Credit Hours">{{ $subject->credit_hrs }}</td>
                        @foreach($professors as $professor)
                            @if($professor->id === $subject->prof_id)
                                <td data-label="Professor">{{ $professor->full_name }}</td>
                            @endif
                        @endforeach
                        <td>{{ $subject->acad_term->academic_term }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
      </table>

      <div class="content-title">
        Sections
      </div>

      <table>
        <thead>
          <tr>
          <th scope="col"> Section </th>
            <th scope="col"> Adviser </th>
            <th scope="col"> Timetable </th>
          </tr>
        </thead>
        <tbody>
          @foreach($sections as $section)
                @if($section->yearlevel_id == $year)
                    <tr>
                        <td data-label="Section">{{ $section->section_name }}</td>
                        @foreach($professors as $professor)
                            @if($professor->id === $subject->prof_id)
                                <td data-label="Professor">{{ $professor->full_name }}</td>
                            @endif
                        @endforeach
                        <td data-label="Timetable" class="view-timetable-link">
                            <a href="{{ route('registrar/timetable', ['id' => $course->id, 'year' => $year]) }}" data-page-title="Timetable" onclick="handleClick(this)">
                                View Timetable
                            </a>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
      </table>
    </main>

    <script src="../../js/selected-nav-label.js" ></script>
  </body>
</html>
