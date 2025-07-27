<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Payment Proof</title>
  <style>
    /* Simple styling for demonstration */
    .payment-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .payment-image {
      max-width: 100%;
      max-height: 100%;
    }
  </style>
</head>
<body>
  <div class="payment-container">
    <img class="payment-image" id="paymentProof" src="{{ asset($imageUrl) }}" alt="Payment Proof">
  </div>
</body>
</html>
