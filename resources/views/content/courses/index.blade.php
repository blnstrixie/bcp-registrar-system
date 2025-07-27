@extends('app')

@section('title', 'Courses')

@section('links')

    <link rel="stylesheet" href="{{ asset('css/grid-cards.css') }}">
@endsection

@section('page-content')

    <div class="content-title">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                List of Courses
            </div>
            <div>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCourseModal">
                    Add Course
                </button>
            </div>

        </div>
    </div>

    <div class="search-bar">
        <input type="text" name="search-box" id="search" placeholder="Search" />

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
                @foreach ($courses as $program)
                    <option value="{{ $value }}">{{ $program }}</option>
                    @php $value++ @endphp
                @endforeach
            </select>

            <select name="year-level" id="year-level" hidden>
                <option selected disabled> Year Level </option>
                @php $value = 1 @endphp
                @foreach ($yearLevels as $years)
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
            <a href="{{ route('courses.info', ['code' => $course->code]) }}" data-page-title="{{ $course->program }}"
                onclick="handleClick(this)">
                <div class="card" id="card-course">
                    <div class="card-stats">
                        <p class="course-label">
                            {{ $course->program }}
                        </p>

                        <div class="course-stats">


                            <p class="card-label">
                                <i class="fa-solid fa-users"></i>
                                <span style="font-weight: 600; font-size:1.2rem">
                                    {{ $course->enrollment_statuses_count }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    {{-- MODAL --}}
    <div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('courses.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Course</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label class="form-label">Program / Course Name: </label>
                            <input type="text" class="form-control" name="program" placeholder="ex. Bachelor of Science in Information Technology" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Course Code: </label>
                            <input type="text" class="form-control" name="code" placeholder="ex. BSIT" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Course Description: </label>
                            <textarea name="description" class="form-control" id="" rows="3" required></textarea>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">College: </label>
                            <input type="text" class="form-control" name="college" placeholder="ex. College of Computer Studies" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Major: </label>
                            <input type="text" class="form-control" name="major" placeholder="ex. Web Development" required>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <label class="form-label">Credit Hours: </label>
                                <input type="number" class="form-control" name="credit_hours" value="120" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label"># of Term: </label>
                                <input type="number" class="form-control" name="no_term" value="2" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
