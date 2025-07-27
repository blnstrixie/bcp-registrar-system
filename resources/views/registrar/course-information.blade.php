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

    <title> Course Information </title>
  </head>

  <body>
    @include('partials/registrar-header')
    @include('partials/registrar-sidebar')

    <main class="container">
      <div class="content-title">
        Course Information
      </div>
      @if($course)
      <div class="student-info">
        <div class="info-group">
          <div class="label"> Description&#58; </div>
          <div class="data"> 
            {{ $course->description }}
          </div>
        </div>

        <div class="info-group">
          <div class="label"> Program&#58; </div>
          <div class="data"> {{ $course->program }} </div>
        </div>

        <div class="info-group">
          <div class="label"> College&#58; </div>
          <div class="data"> {{ $course->college }} </div>
        </div>

        <div class="info-group">
          <div class="label"> Major&#58; </div>
          <div class="data"> {{ $course->major }} </div>
        </div>

        <div class="info-group">
          <div class="label"> Credit Hours&#58; </div>
          <div class="data"> {{ $course->credit_hours }} </div>
        </div>
              
        <div class="info-group">
          <div class="label"> Term&#47;Semester&#58; </div>
          <div class="data"> {{ $course->no_term }} </div>
        </div>

        <div class="info-group">
          <div class="label"> Students Enrolled&#58; </div>
          <div class="data"> {{ $enrolledCount }} </div>
        </div>
      </div>

      <div class="content-title" id="yrlvl-sec">
        Year Levels
      </div>

      <div class="cards-container" id="cards-container-course-info">
        <a href="{{ route('perYear', ['id' => $course->id, 'year' => 1]) }}">
          <div class="card" id="card-course-info">
            <div class="card-stats">
              <p class="label-yrlvl">
                First Year
              </p>
            </div>
          </div>
        </a>

        <a href="{{ route('perYear', ['id' => $course->id, 'year' => 2]) }}">
          <div class="card" id="card-course-info">
            <div class="card-stats">
              <p class="label-yrlvl">
                Second Year
              </p>
            </div>
          </div>
        </a>

        <a href="{{ route('perYear', ['id' => $course->id, 'year' => 3]) }}">
          <div class="card" id="card-course-info">
            <div class="card-stats">
              <p class="label-yrlvl">
                Third Year
              </p>
            </div>
          </div>
        </a>

        <a href="{{ route('perYear', ['id' => $course->id, 'year' => 4]) }}">
          <div class="card" id="card-course-info">
            <div class="card-stats">
              <p class="label-yrlvl">
                Fourth Year
              </p>
            </div>
          </div>
        </a>
      </div>
      
      @else
          <div class="error-message">
              Course information not found.
          </div>
      @endif
    </main>

    <script src="js/selected-nav-label.js" ></script>
  </body>
</html>