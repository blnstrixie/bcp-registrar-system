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
                List of Students
            </div>
            <div>

                {{-- <a href="{{ route('students.create') }}" class="btn btn-success">Add Student</a> --}}
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-5">
            <div class="table-responsive">
                <table id="tblStudents" class="table table-striped" style="width:100%;">
                    <thead>
                        <tr>
                            <th scope="col"> Student Number </th>
                            <th scope="col"> Name </th>
                            <th scope="col"> Course </th>
                            <th scope="col"> Year Level </th>
                            <th scope="col"> Section </th>
                            <th scope="col"> Academic Year </th>
                            <th scope="col"> Status </th>
                            <th scope="col"> Type </th>
                            <th scope="col"> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal" id="myModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form>
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Add Student</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
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
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            StudentsInit();
        });

        function StudentsInit() {
            $('#tblStudents').DataTable({
                select: true,
                "lengthMenu": [10, 25, 50, 75, 100],
                "lengthChange": true,
                scrollCollapse: true,
                deferRender: true,
                scroller: true,
                ordering: false,
                initComplete: function(settings, json) {
                    $('body').find('.dataTables_scrollBody').addClass("scrollbar");
                },
                "searching": true,
                autoWidth: false,
                responsive: true,
                processing: true,
                destroy: true,
                serverSide: true,
                ajax: {
                    "type": "GET",
                    "url": '{{ route('students.list') }}'
                },
                columns: [{
                        'data': 's_number'
                    },
                    {
                        'data': 'name'
                    },
                    {
                        'data': 'course'
                    },
                    {
                        'data': 'y_level'
                    },
                    {
                        'data': 'section'
                    },
                    {
                        'data': 'a_year'
                    },
                    {
                        'data': 'status'
                    },
                    {
                        'data': 'classification'
                    },
                    {
                        'data': 'action'
                    },
                ],
                "drawCallback": function(settings) {

                }
            });
        }
    </script>
@endsection
