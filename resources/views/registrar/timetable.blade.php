<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6cbb66e0e0.js" crossorigin="anonymous"></script>
    <link rel="icon" href="../../../icons/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../../../icons/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../../css/header.css">
    <link rel="stylesheet" href="../../../css/sidebar.css">
    <link rel="stylesheet" href="../../../css/general.css">
    <link rel="stylesheet" href="../../../css/style.css">
    <link rel="stylesheet" href="../../../css/table.css">

    <title> Timetable </title>
  </head>

  <body>
    @include('partials/registrar-header')
    @include('partials/registrar-sidebar')

    <main class="container">
      <div class="content-title">
        Timetable
      </div>

      <table>
        <thead>
          <tr>
            <th scope="col"> Code </th>
            <th scope="col"> Subject Title </th>
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
    </main>

    <script src="../../../js/selected-nav-label.js" ></script>
  </body>
</html>