<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6cbb66e0e0.js" crossorigin="anonymous"></script>
    <link rel="icon" href="icons/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="icons/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/overlay.css">

    <title> Document Request and Status </title>
  </head>

  <body>
    @include('partials/student-header')
    @include('partials/student-sidebar')

    <main class="container">
      <div class="tabs">
        <!-- Request Document Tab -->
        <input type="radio" name="tabs" id="tab1" checked>
        <label for="tab1"> Request Document </label>

        <!-- Document Deficiencies Tab -->
        <input type="radio" name="tabs" id="tab2">
        <label for="tab2"> Document Deficiencies </label>

        <!-- Request Document Tab Content -->
        <div class="tab-content" id="tab1-content">
          <div class="tab-content-container">
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
                    @foreach($documents as $docs)
                      <option value="{{ $docs->id }}" data-price="{{ $docs->fee }}"> {{ $docs->document_name }} </option> 
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
                    @foreach($paymentmethods as $method)
                      <option value="{{ $method->id }}" data-qrcode="{{ $method->qr_code }}"> {{ $method->payment_method }} </option> 
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

            <div class="content-title" id="student-requests">
              List of Request&#40;s&#41;
            </div>

            <div class="sub-title">
              Pending
            </div>

            @foreach($matchedRequests as $request)
            @if($request->status === 'Pending')
              <div class="students-requests-container">
                <div class="students-requests">
                  <p id="postedRequests">
                    You requested
                    <strong>
                      @if($request->document)
                          {{ $request->document->document_name }}
                      @else
                          No Document Available
                      @endif
                    </strong>
                  <br>
                    <em>{{ $request->created_at->format('m/d/Y h:i:s A') }}</em>
                  </p>

                  <div class="request-btns">
                    <button class="view" id="" onclick="toggleOverlay({{ $request->id }})">
                      View Details
                    </button>
                  </div>
                </div>
              </div>
            @endif
            @endforeach
  
            <div class="sub-title">
              In-Process
            </div>

            @foreach($matchedRequests as $request)
            @if($request->status === 'In-Process')
            <div class="students-requests">
              <p id="postedRequests">
                Processing
                <strong>
                  @if($request->document)
                      {{ $request->document->document_name }}
                  @else
                      No Document Available
                  @endif
                </strong>
              <br>
                <em> {{ $request->updated_at->format('m/d/Y h:i:s A') }}</em>
              </p>

              <div class="request-btns">
                <button class="done-btn" id="" onclick="toggleProcessOverlay({{ $request->id }})">
                  View Message
                </button>
          
                <div id="startprocess-overlay-{{ $request->id }}" class="overlay" style="display: none;">
                  <div class="overlay-content">
                    <button class="close-btn" onclick="toggleProcessOverlay({{ $request->id }})">&times;</button>
          
                    <div class="form">
                      <div class="content-title">
                        Message
                      </div>
          
                      <div class="reg-message">
                        {{ $request->registrar_message }}
                      </div>
                    </div>
                  </div>
                </div>

                <button class="view" id="" onclick="toggleOverlay({{ $request->id }})">
                  View Details
                </button>
              </div>
            </div>
            @endif
            @endforeach

            <div class="sub-title">
              Finished
            </div>

            @foreach($matchedRequests as $request)
              @if($request->status === 'Finished')
              <div class="students-requests">
                <p id="postedRequests">
                  <strong>
                    @if($request->document)
                        {{ $request->document->document_name }}
                    @else
                        No Document Available
                    @endif
                  </strong>
                <br>
                  <em>{{ $request->updated_at->format('m/d/Y h:i:s A') }}</em>
                </p>

                <button class="view" id="" onclick="toggleOverlay({{ $request->id }})">
                  View Details
                </button>

                @include('partials/view-details-overlay')
              </div>
              @endif
            @endforeach
        </div>

        <!-- Document Deficiencies Tab Content -->
        <div class="tab-content" id="tab2-content">
          <div class="tab-content-container">
            <div class="content-title">
              List of Document Deficiencies
            </div>

            <div class="subtitle">
              Below is a list of documents that must be submitted to the Registrar's Office within the specified deadline
            </div>

            @if($deficiencies->isNotEmpty())
              @foreach($deficiencies as $key => $deficiency)
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
    </main>
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
    <script src="js/selected-nav-label.js" ></script>
    <script src="js/overlay_stud.js" defer></script>
    <script src="js/startprocess-overlay.js" defer></script>
  </body>
</html>