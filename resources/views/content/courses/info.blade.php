@extends('app')

@section('title', 'Courses Info: '.$course->program)

@section('links')

<link rel="stylesheet" href="{{ asset('css/grid-cards.css') }}">
@endsection

@section('page-content')

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
    <a href="{{ route('courses.info.year-level', ['code' => $course->code, 'year' => 1]) }}">
      <div class="card" id="card-course-info">
        <div class="card-stats">
          <p class="label-yrlvl">
            First Year
          </p>
        </div>
      </div>
    </a>

    <a href="{{ route('courses.info.year-level', ['code' => $course->code, 'year' => 2]) }}">
      <div class="card" id="card-course-info">
        <div class="card-stats">
          <p class="label-yrlvl">
            Second Year
          </p>
        </div>
      </div>
    </a>

    <a href="{{ route('courses.info.year-level', ['code' => $course->code, 'year' => 3]) }}">
      <div class="card" id="card-course-info">
        <div class="card-stats">
          <p class="label-yrlvl">
            Third Year
          </p>
        </div>
      </div>
    </a>

    <a href="{{ route('courses.info.year-level', ['code' => $course->code, 'year' => 4]) }}">
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

@endsection

@section('scripts')
@endsection
