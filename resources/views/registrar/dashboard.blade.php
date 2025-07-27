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
      <link rel="stylesheet" href="../css/grid-cards.css">
      <link rel="stylesheet" href="../css/general.css">
      <link rel="stylesheet" href="../css/style.css">
      <link rel="stylesheet" href="../css/table.css">
      <link rel="stylesheet" href="../css/overlay.css">

      <title> Analytics </title>
  </head>

  <body>
      @include('partials/registrar-header')
      @include('partials/registrar-sidebar')

      <main>
          <div class="top">
              Welcome, {{ $user->firstname }}

              <p class="top-message">
                Greetings from the BCP Registrar System! You may now access the student records.
              </p>
          </div>

          <div class="cards-container">
              <div class="card">
                  <i class="fa-solid fa-users"></i>

                  <div class="card-stats">
                      <p class="number">
                        {{ $totalStudentCount }}
                      </p>
                      <p class="card-label">
                          Students
                      </p>
                  </div>
              </div>

              <div class="card">
                  <i class="fa-solid fa-book-open-reader"></i>

                  <div class="card-stats">
                      <p class="number">
                          {{ $totalCourseCount }}
                      </p>
                      <p class="card-label">
                          Courses
                      </p>
                  </div>
              </div>

              <div class="card">
                  <i class="fa-solid fa-bell"></i>

                  <div class="card-stats">
                      <p class="number">
                          {{ $totalRequestsCount }}
                      </p>
                      <p class="card-label">
                          Requests
                      </p>
                  </div>
              </div>
          </div>

          <div class="requests-container">
              <div class="table-caption">
                  Requests
              </div>

              <table class="requests">
                  <thead>
                      <tr>
                          <th scope="col"> Request Number </th>
                          <th scope="col"> Name </th>
                          <th scope="col"> Request </th>
                          <th scope="col"> Date </th>
                          <th scope="col"> Action </th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach($requests as $request)
                    @if($request->status != 'Finished')
                        <tr>
                            <td data-label="Request Number">{{ $request->id }}</td>
                            <td data-label="Name">
                                {{ $request->firstname }} {{ $request->middlename }} {{ $request->lastname }}
                            </td>
                            <!-- Include other columns from the "requests" table as needed -->
                            <td data-label="Request">
                                @if($request->document)
                                    {{ $request->document->document_name }}
                                @else
                                    No Document Available
                                @endif
                            </td>
                            <td data-label="Date">{{ $request->created_at->format('F d, Y') }}</td>
                            <td data-label="Action">
                                <a href="{{ route('registrar/student-profile', ['studentNum' => $request->studentNum]) }}" data-page-title="Student Information" onclick="handleClick(this)">
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

      <script src="../js/selected-nav-label.js" ></script>
      <script src="../js/delete-overlay.js" defer></script>
  </body>
</html>
