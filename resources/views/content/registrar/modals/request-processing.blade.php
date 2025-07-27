
<div class="modal fade" id="processDocModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Process Document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('updatePending', ['id' => $request->id]) }}" class="form" method="POST" id="frmProcessRequest">
                    @csrf
                    <div class="pair mb-3">
                        <div class="settings-label">
                            Message
                        </div>

                        <textarea class="form-control" rows="5" name="message">We're currently preparing your document. Please come to the registrar's office on [DAY] between [START TIME] and [END TIME] to pick up your document.</textarea>
                    </div>
                    <button class="send-btn" name="submit" type="submit">
                        Send
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="viewDocModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Document Requested</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container" id="doc_body"></div>
            </div>
        </div>
    </div>
</div>
