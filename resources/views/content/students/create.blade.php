@extends('app')
@section('title')
    Students
@endsection
@section('links')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
@endsection

@section('page-content')
    <div class="content-title">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                Add Student
            </div>
            <div>
            </div>
        </div>
    </div>
    <div class="card rounded-0">
        <div class="card-body">
            <div class="card-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label class="form-label">Student No.</label>
                        <input type="text" class="form-control" name="student_no" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="last_name" required>
                        </div>
                        <div class="col-4">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" name="first_name" required>
                        </div>
                        <div class="col-4">
                            <label class="form-label">Middle Name</label>
                            <input type="text" class="form-control" name="middle_name" required>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
@endsection
