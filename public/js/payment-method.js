function PaymentMethodOverlay() {
    var overlay = document.getElementById('paymentmethod-overlay');
    overlay.style.display = (overlay.style.display === 'none' || overlay.style.display === '') ? 'block' : 'none';
  }