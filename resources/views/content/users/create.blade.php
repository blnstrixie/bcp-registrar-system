@extends('app')
@section('title')
    User Management
@endsection
@section('links')
    {{-- <link rel="stylesheet" href="{{ asset('assets/bootstrap-select/css/bootstrap-select.min.css') }}"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
@endsection

@section('page-content')
    <div class="d-flex justify-content-start mb-3">
        <a href="{{ route('user-management') }}" type="button" class="btn btn-secondary">Back to Users List</a>
    </div>
    <div class="content-title">
        Add User Account
    </div>

    <div class="card shadow-lg">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('user-management.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row mb-2">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Last Name:</label>
                            <input required type="text" class="form-control" value="{{ old('last_name') }}" name="last_name" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>First Name:</label>
                            <input required type="text" class="form-control"  value="{{ old('first_name') }}" name="first_name">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Middle Name:</label>
                            <input required type="text" class="form-control"  value="{{ old('middle_name') }}" name="middle_name">
                        </div>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <label>Email Address:</label>
                    <input required type="email" class="form-control" value="{{ old('email') }}" name="email">
                </div>
                <div class="form-group mb-2">
                    <label>Role</label>
                    <select value="{{ old('role') }}" name="role" class="form-control form-select" id="userRole" required>
                        {{-- <option value=""></option> --}}
                        <option value="Registrar">Registrar</option>
                        <option value="Teacher">Teacher</option>
                    </select>
                </div>
                <div class="form-group mb-2" id="coursesContainer">
                    <label>Course Access</label>
                    <select class="selectCourses form-control" data-live-search="true" multiple required name="course_access[]">
                        @foreach (\App\Models\Courses::get() as $course)
                            <option value="{{ $course->id }}">{{ $course->program }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-2">
                    <label>Complete Address:</label>
                    <input type="text" class="form-control" value="{{ old('complete_address') }}" name="complete_address">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>

            </form>
        </div>
    </div>

@endsection


@section('scripts')
{{-- <script src="{{ asset('assets/bootstrap-select/js/bootstrap-select.min.js') }}"></script> --}}

<!-- Latest compiled and minified JavaScript -->
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script> --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/i18n/defaults-*.min.js"></script> --}}

<script>
    $('#userRole').on('change', function () {
        role = $(this).val();
        if(role == 'Registrar') {
            $('#coursesContainer').show();
            $(".selectCourses").attr("required", "true");
        }
        else {
            $(".selectCourses").removeAttr("required");
            $('#coursesContainer').hide();
        }
    })
    // To style only selects with the my-select class
    $('.selectCourses').selectpicker()
</script>
@endsection
