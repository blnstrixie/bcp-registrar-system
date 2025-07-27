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


    <title> Audit Trail </title>
  </head>

  <body>
    @include('partials/registrar-header')
    @include('partials/registrar-sidebar')

    <main class="container">
      <div class="content-title">
        Audit Logs
      </div>

      {{-- <div class="audit-row">
        <div class="search-bar auditsearch">
          <input type="text" name="search" id="search" placeholder="Search"/>

          <button class="search-btn">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
        </div>

        <div class="date-range">
          <div class="date-input">
            <input type="date" id="start-date" name="start-date">
          </div>

          <div class="date-input">
            <label for="end-date"> To </label>
            <input type="date" id="end-date" name="end-date">
          </div>
        </div>

        <div class="audit-btns">
          <button class="reset-btn"> Reset </button>
          <button class="apply-btn"> Apply </button>
        </div>
      </div> --}}

      <table>
        <thead>
          <tr>
            <th width="20%"> Timestamp </th>
            <th width="10%"> Source </th>
            <th width="10%"> Category </th>
            <th width="10%"> Action </th>
            <th width="50%"> Description </th>
          </tr>
        </thead>
        <tbody>
            @foreach ($audit_logs as $log)
                <tr>
                    <td>{{ $log->created_at }}</td>
                    <td>{{ $log->source }}</td>
                    <td>{{ $log->category }}</td>
                    <td>{{ $log->action }}</td>
                    <td>{!! $log->description !!}</td>
                </tr>
            @endforeach
        </tbody>
      </table>
    </main>

    <script src="../js/selected-nav-label.js"></script>
  </body>
</html>
