@extends('app')
@section('title')
    Enrollment Reports
@endsection
@section('links')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
@endsection

@section('page-content')
    <div class="content-title">
        <div class="row">
            <div class="col-lg-8">
                Enrollment Report

            </div>
            <div class="col-lg-2">
                <form>
                    <div class="d-flex justify-content-between">
                        <div>

                            <input type="number" class="form-control mb-2 mr-sm-2" id="year" name="year"
                                value="{{ $academic_year }}" min="{{ $min_ay }}" max="{{ $max_ay }}" required
                                placeholder="Year">
                            {{-- <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Jane Doe"> --}}
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary mb-2">Filter</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <a href="{{ route('reports.enrollment.print', ['year' => $academic_year]) }}" target="_blank">
        <button class="print-btn" id="print-btn-course">
            Print <i class="fa-solid fa-print"></i>
        </button>
    </a>

    <div class="content-subtitle">
        <i class="fa-solid fa-chart-line"></i> Total Enrollment This {{ $academic_year . ' - ' . $academic_year + 1 }}
    </div>
    <div class="total-enrolled-count" style="width: 60px; height: 60px ">
        {{ $totalEnrollmentCount }}
    </div>

    <div class="content-subtitle">
        <i class="fa-solid fa-chart-line"></i> Total Students Enrolled per Course
    </div>
    <table class="total-enrolled-tbl">
        <thead>
            <tr>
                <th scope="col"> Course </th>
                <th scope="col"> Total Students </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($studentsPerCourse as $student)
                <tr>
                    <td data-label="Course">{{ $courses[$student->course_id] }}</td>
                    <td data-label="Total Students">

                        <a href="javascript:void(0)" onclick="show_students('course','{{ $courses[$student->course_id] }}', '{{ $academic_year }}')">
                            {{ $student->total_students }}
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="content-subtitle">
        <i class="fa-solid fa-chart-line"></i> Total Students Enrolled per Year-Level
    </div>
    <table class="total-enrolled-tbl">
        <thead>
            <tr>
                <th scope="col"> Year&#45;Level </th>
                <th scope="col"> Total Students </th>
            </tr>
        </thead>
        <tbody>
            @php

            @endphp
            @foreach ($year_level_count as $key => $count)
                <tr>
                    <td data-label="Year-Level">
                        {{ ucwords($key) }}
                    </td>

                    <td data-label="Total Students">
                        <a href="javascript:void(0)" onclick="show_students('year_level','{{ $key }}', '{{ $academic_year }}')">
                            {{ ucwords($count) }}
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="content-subtitle">
        <i class="fa-solid fa-chart-line"></i> Total Students Enrolled per Gender
    </div>
    <table>
        <thead>
            <tr>
                <th scope="col"> Gender </th>
                <th scope="col"> Total Students </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td data-label="Gender"> Female </td>
                <td data-label="Total Students">
                    <a href="javascript:void(0)" onclick="show_students('gender','Female', '{{ $academic_year }}')">
                        {{ $enrolled_female }}
                    </a>
                </td>
            </tr>
            <tr>
                <td data-label="Gender"> Male </td>
                <td data-label="Total Students">
                    <a href="javascript:void(0)" onclick="show_students('gender','Male', '{{ $academic_year }}')">
                        {{ $enrolled_male }}
                    </a>
                </td>
            </tr>
        </tbody>
    </table>


    {{-- MODALS --}}
    <!-- TOTAL STUDENTS PER COURSE Modal -->
    <div class="modal fade" id="showStudents" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">TOTAL STUDENT</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container" id="students">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        function show_students(type,params,acad_year) {
            $('#showStudents').modal('show')
            $.ajax({
                type : 'GET',
                url  : '{{ route("enrollment_reports.show-students") }}',
                data : {'type' : type, 'acad_year' : acad_year, 'params' : params},
                success: function (data) {
                    $('#showStudents #students').html(data);
                }
            })
        }
    </script>

@endsection
