@extends('app')
@section('title')
    Audit Trail
@endsection
@section('links')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
@endsection

@section('page-content')
    <div class="content-title">
        Audit Logs
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="tblLogs" class="table table-striped" style="width:100%;">
                    <thead>
                        <tr>
                            <th width="20%"> Timestamp </th>
                            <th width="10%"> Source </th>
                            <th width="10%"> Category </th>
                            <th width="10%"> Action </th>
                            <th width="50%"> Description </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
        LogsInit();
    });

    function LogsInit() {
        $('#tblLogs').DataTable({
            select: true,
            "lengthMenu": [10, 25, 50, 75, 100 ],
            "lengthChange": true,
            scrollX: true,
            scrollCollapse: true,
            deferRender:    true,
            scroller:       true,
            initComplete: function (settings, json) {
                $('body').find('.dataTables_scrollBody').addClass("scrollbar");
            },
            "searching": true,
            "info":false,
            // responsive: true,
            serverSide:true,
            processing: true,
            ajax:'',
            columns:[
                {'data':'timestamp'},
                {'data':'source'},
                {'data':'category'},
                {'data':'action'},
                {'data':'description'}
            ]
        });
    }
</script>
@endsection
