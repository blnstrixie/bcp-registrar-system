

<div class="modal fade" id="requestDocumentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Request Document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('requests') }}" class="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="container" style="width: 100%">
                        <div class="content-title text-center mb-3">
                            Request Form
                        </div>

                        <div class="subtitle text-center">
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
            </div>
        </div>
    </div>
</div>
