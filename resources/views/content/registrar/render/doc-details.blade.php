<div class="row mb-2">
    <div class="col-lg-5">Name: </div>
    <div class="col-lg-7">{{ $doc_req->user->lastname.', '. $doc_req->user->firstname.' '.$doc_req->user->middlename }}</div>
</div>
<div class="row mb-2">
    <div class="col-lg-5">Document: </div>
    <div class="col-lg-7">{{ $doc_req->document->document_name }}</div>
</div>
<div class="row mb-2">
    <div class="col-lg-5">Fee: </div>
    <div class="col-lg-7">₱{{ number_format(round($doc_req->document->fee,2),2) }}</div>
</div>
<div class="row mb-2">
    <div class="col-lg-5">Mode of Payment</div>
    <div class="col-lg-7">{{ $doc_req->paymentmethod->payment_method ?? 'Undefined'}}</div>
</div>
<div class="row mb-2">
    <div class="col-lg-5">Proof of Payment</div>
    @php
        $source = asset($doc_req->paymentProof);
    @endphp
    <div class="col-lg-7"><a href="{{ $source ?? 'Not Found.' }} " target="_blank">View Proof</a></div>
</div>
<div class="row mb-2">
    <div class="col-lg-5">Request Status: </div>
    <div class="col-lg-7">{{ $doc_req->status }}</div>
</div>
