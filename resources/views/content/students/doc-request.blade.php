@extends('app')
@section('title')
    Document Requests
@endsection
@section('links')
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
@endsection

@section('page-content')
    <div class="tabs">
        <!-- Request Document Tab -->
        <input type="radio" name="tabs" id="tab1" checked>
        <label for="tab1"> Request Document </label>

        <!-- Document Deficiencies Tab -->
        <input type="radio" name="tabs" id="tab2">
        <label for="tab2"> Document Deficiencies </label>

        <!-- Request Document Tab Content -->
        <div class="tab-content" id="tab1-content">
            {{-- <div class="tab-content-container">
                <div class="content-title">
                    Submit a Document Request
                </div>

                <form action="{{ route('requests') }}" class="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="request-container">
                        <div class="content-title">
                            Request Form
                        </div>

                        <div class="subtitle">
                            Document fees may vary depending on the type of document.
                        </div>

                        <div class="requestpair-container">
                            <div class="request-pair">
                                <div class="request-label">
                                    Document
                                </div>
                                <input type="hidden" name="studentNum" value="{{ $user->studentNum }}">
                                <input type="hidden" name="status" value="Pending">
                                <select name="documentId" id="documentSelect">
                                    <option disabled selected> Select a Document </option>
                                    @foreach ($documents as $docs)
                                        <option value="{{ $docs->id }}" data-price="{{ $docs->fee }}">
                                            {{ $docs->document_name }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="request-pair">
                                <div class="request-label">
                                    Fee
                                </div>

                                <div class="request-data" id="priceFee">

                                </div>
                            </div>

                            <div class="request-pair">
                                <div class="request-label">
                                    Payment Method
                                </div>

                                <select name="paymentmethodId" id="paymentMethodSelect">
                                    <option disabled selected> Select a Payment Method </option>
                                    @foreach ($paymentmethods as $method)
                                        <option value="{{ $method->id }}" data-qrcode="{{ $method->qr_code }}">
                                            {{ $method->payment_method }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="request-pair">
                                <div class="request-label">
                                    QR Code
                                </div>

                                <div class="request-data" id="qrCodeDisplay">

                                </div>
                            </div>

                            <div class="request-pair">
                                <div class="request-label">
                                    Proof of Payment
                                </div>

                                <input type="file" name="paymentProof">
                            </div>
                        </div>

                        <button class="submit-btn" type="submit">
                            Submit
                        </button>
                    </div>
                </form>
            </div> --}}

            {{-- <div class="content-title mb-1" id="student-requests">
                List of Request&#40;s&#41;
            </div> --}}

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h4>List of Requests</h4>
                </div>
                <div>
                    <button type="button" class="btn btn-success" id="docRequest">Request Document</button>
                </div>
            </div>

            {{-- PENDING REQUEST --}}
            <div class="card mb-3 shadow-lg">
                <div class="card-body">
                    <div class="">
                        <div class="sub-title">
                            Pending
                        </div>

                        <table class="table table-striped" id="tblPendingReqs" style="width: 100%">
                            <thead style="text-align: center;">
                                <th><center>Doc Type</center></th>
                                <th><center>Status</center></th>
                                <th><center>Date Requested</center></th>
                                <th><center>Action</center></th>
                            </thead>
                            <tbody>
                                @foreach ($student_requests as $item)
                                    @if ($item->status === 'Pending')
                                        <tr>
                                            <td>{{ $item->document->document_name }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>{{ date('m/d/Y h:i A', strtotime($item->created_at)) }}</td>
                                            <td>
                                                <button class="view" id=""
                                                    onclick="viewDoc({{ $item->id }})">
                                                    View Details
                                                </button>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- PROCESSING REQUEST --}}
            <div class="card mb-3 shadow-lg">
                <div class="card-body">
                    <div class="sub-title">
                        IN-PROCESS
                    </div>

                    <table class="table table-striped" id="tblProcessingReqs" style="width: 100%">
                        <thead>
                            <th>Doc Type</th>
                            <th>Status</th>
                            <th>Date Requested</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($student_requests as $item)
                                @if ($item->status === 'In-Process')
                                    <tr>
                                        <td>{{ $item->document->document_name }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ date('m/d/Y h:i A', strtotime($item->created_at)) }}</td>
                                        <td>
                                            <button class="view" id="" onclick="viewDoc({{ $item->id }})">
                                                View Details
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- FINISHED REQUEST --}}
            <div class="card mb-3 shadow-lg">
                <div class="card-body">
                    <div class="sub-title">
                        FINISHED
                    </div>

                    <table class="table table-striped" id="tblFinishedReqs" style="width: 100%">
                        <thead>
                            <th>Doc Type</th>
                            <th>Status</th>
                            <th>Date Requested</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($student_requests as $item)
                                @if ($item->status === 'Finished')
                                    <tr>
                                        <td>{{ $item->document->document_name }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ date('m/d/Y h:i A', strtotime($item->created_at)) }}</td>
                                        <td>
                                            <button class="view" id="" onclick="viewDoc({{ $item->id }})">
                                                View Details
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @foreach ($matchedRequests as $request)
            @endforeach
        </div>

        <!-- Document Deficiencies Tab Content -->
        <div class="tab-content" id="tab2-content">
            <div class="tab-content-container">
                <div class="content-title">
                    List of Document Deficiencies
                </div>

                <div class="subtitle">
                    Below is a list of documents that must be submitted to the Registrar's Office within the specified
                    deadline
                </div>

                @if ($deficiencies->isNotEmpty())
                    @foreach ($deficiencies as $key => $deficiency)
                        <div class="one-line">
                            <div class="number-data">
                                {{ $key + 1 }}
                            </div>

                            <div class="list-pair">
                                <div class="list">
                                    <div class="list-label">
                                        Document
                                    </div>

                                    <div class="list-data">
                                        {{ $deficiency->document }}
                                    </div>
                                </div>

                                <div class="list">
                                    <div class="list-label">
                                        Deadline
                                    </div>

                                    <div class="list-data">
                                        {{ date('d/m/Y', strtotime($deficiency->deadline)) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>This student has no outstanding deficiencies at the moment. Keep up the good work!</p>
                @endif

            </div>
        </div>
    </div>

    <!-- Message Modal -->
    <div class="modal fade" id="messageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <p id="message"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @include('content.registrar.modals.request-processing')
    @include('content.students.doc-request-form')

@endsection


@section('scripts')
    <script>

        $(document).ready(function() {

            // $('#tab2').prop('checked', true).trigger('change');
            @if (Session::has('saved-session-tab'))
                $('#tab{{ Session::get('saved-session-tab') }}').prop('checked', true).trigger('change');
            @endif
            // $('#tab2').prop('checked', true).trigger('change');
        })
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const select = document.getElementById('documentSelect');
            const priceDisplay = document.getElementById('priceFee');

            select.addEventListener('change', function() {
                const selectedOption = select.options[select.selectedIndex];
                const price = selectedOption.getAttribute('data-price');

                if (price !== null) {
                    const parsedPrice = parseFloat(price);

                    if (parsedPrice === 0) {
                        priceDisplay.textContent = 'This document has no associated fee.';
                    } else {
                        priceDisplay.textContent = `${parsedPrice} Pesos`;
                    }
                } else {
                    priceDisplay.textContent = 'Price information unavailable for this document.';
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const methodSelect = document.getElementById('paymentMethodSelect');
            const qrCodeDisplay = document.getElementById('qrCodeDisplay');

            methodSelect.addEventListener('change', function() {
                const selectedOption = methodSelect.options[methodSelect.selectedIndex];
                const qrCode = selectedOption.getAttribute('data-qrcode');

                if (qrCode) {
                    qrCodeDisplay.innerHTML = `<img class="qr-code" src="${qrCode}">`;
                } else {
                    qrCodeDisplay.textContent = 'QR code not available for this payment method.';
                }
            });
        });
    </script>
    <script src="js/overlay_stud.js" defer></script>
    <script src="js/startprocess-overlay.js" defer></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $('#tblPendingReqs').DataTable({
            select: true,
            "lengthMenu": [10, 25, 50, 75, 100],
            "lengthChange": true,
        })
        $('#tblProcessingReqs').DataTable({
            select: true,
            "lengthMenu": [10, 25, 50, 75, 100],
            "lengthChange": true,
        })
        $('#tblFinishedReqs').DataTable({
            select: true,
            "lengthMenu": [10, 25, 50, 75, 100],
            "lengthChange": true,
        })
    </script>
    <script>
        function view_message(id) {
            $('.modal#messageModal p#message').text('Please wait...');
            $('#messageModal').modal('show');
            $.ajax({
                type: 'GET',
                url: '{{ route('doc.get.message') }}',
                data: {
                    'id': id
                },
                success: function(data) {
                    $('.modal#messageModal p#message').text(data.message);
                },
                error: function(data) {
                    $('.modal#messageModal p#message').text('Something went wrong.');
                }
            });

        }

        function viewDoc(id) {
            $('#viewDocModal').modal('show')
            $.ajax({
                type: 'GET',
                url: '{{ route('request.view-doc') }}',
                data: {
                    'id': id
                },
                success: function(data) {
                    $('#viewDocModal #doc_body').html(data);
                }
            })
        }

        $('#docRequest').on('click',function () {
            $('#requestDocumentModal').modal('show');
        })
    </script>
@endsection
