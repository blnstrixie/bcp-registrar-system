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
    <link rel="stylesheet" href="css/grid-cards.css">
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/table.css">

    <title> Analytics </title>
  </head>

  <body>
      @include('partials/student-header')
      @include('partials/student-sidebar')

    <main>
      <div class="top">
        Welcome, {{ $user->firstname }}

        <p class="top-message">
          Greetings from the BCP Registrar System! You can now access this system as a student
        </p>
      </div>

      <div class="cards-container">
          <div class="card">
            <div class="card-stats">
              <p class="course-label">
                {{ $course->program }}
              </p>

              <div class="course-stats">
                <i class="fa-solid fa-book-open-reader"></i>

                <p class="card-label">
                  Course
                </p>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-stats">
              <p class="course-label">
                Bulacan <br> {{ $section->section_name }}
              </p>

              <div class="course-stats">
                <i class="fa-solid fa-school"></i>

                <p class="card-label">
                  Section
                </p>
              </div>
            </div>
          </div>

        <div class="card">
          <i class="fa-solid fa-bell"></i>

          <div class="card-stats">
            <p class="number">
              {{ $totalNotifications }}
            </p>
            <p class="card-label">
              Notifications
            </p>
          </div>
        </div>
      </div>
      </div>

      <div class="requests-container">
        <div class="table-caption">
          Active Requests
        </div>

        <table class="requests">
          <thead>
            <tr>
              <th scope="col"> Request Number </th>
              <th scope="col"> Request </th>
              <th scope="col"> Date </th>
              <th scope="col"> Message </th>
              <th scope="col"> Action </th>
            </tr>
          </thead>
          <tbody>
            @foreach($matchedRequests as $request)
              @if($request->notification_status === 1)
              <tr>
                <td data-label="Request Number"> {{ $request->notification_id}} </td>
                <td data-label="Request"> {{ $request->document_name }} </td>
                <td data-label="Date"> {{ date('F d, Y', strtotime($request->updated)) }} </td>
                <td data-label="Status">
                  @if($request->status === 'In-Process' || $request->status === 'Pending' )
                      {{ $request->registrar_message }}
                  @else
                      Done
                  @endif
              </td>
                <td data-label="Action">
                  <a href="{{ route('student/documents-hub') }}" data-page-title="Documents Hub" onclick="handleClick(this)">
                    <button class="view-btn">
                      <i class="fa-solid fa-eye"></i>
                    </button>
                  </a>
                </td>
              </tr>
              @endif
            @endforeach
          </tbody>
        </table>
      </div>
    </main>

    <script src="js/selected-nav-label.js" ></script>
  </body>
</html>
