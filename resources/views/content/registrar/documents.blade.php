@extends('app')
@section('title')
    Documents
@endsection
@section('links')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
@endsection

@section('page-content')
    <div class="content-title">
        Document Reports
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <th>#</th>
                        <th>Document Type</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Transcript of Records (TOR)</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-warning" id="btnTOR"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODALS --}}
    <div class="modal fade" id="torModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Transcript of Records</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Students Record</p>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="tblFetchStudents" style="width: 100%">
                                    <thead>
                                        <th>Student #</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
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

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
    $('#btnTOR').on('click', function () {
        InitStudents();
        $('#torModal').modal('show')
    })

    function InitStudents() {
        $('#tblFetchStudents').DataTable({
            select: true,
            "lengthMenu": [10, 25, 50, 75, 100 ],
            "lengthChange": true,
            scrollCollapse: true,
            deferRender:    true,
            scroller:       true,
            initComplete: function (settings, json) {
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
                "url" : '{{ route('documents.fetch-students') }}'
            },
            columns:[
                {'data':'stud_no'},
                {'data':'name'},
                {'data':'action'},
            ],
            "drawCallback": function( settings ) {

            }
        });
    }
</script>
@endsection
