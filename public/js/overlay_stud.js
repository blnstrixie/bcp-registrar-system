function Overlay() {
    var overlay = document.getElementById('overlay');
    overlay.style.display = (overlay.style.display === 'none' || overlay.style.display === '') ? 'block' : 'none';
  }
  
  function toggleOverlay(currentItemID) {
    fetch(`/getdetails/${currentItemID}`)
      .then(response => response.json())
      .then(data => {
        const firstName = data.firstName || '';
        const middleName = data.middleName || '';
        const lastName = data.lastName || '';
        const fullName = `${firstName} ${middleName} ${lastName}`.trim();
  
        const fee = data.fee !== null ? `${data.fee} Pesos` : 'Fee not available';
        const paymentMethod = data.paymentMethod !== null ? data.paymentMethod : 'Payment method not specified';

        document.getElementById('id').textContent = data.id;
        document.getElementById('nameDetails').textContent = fullName;
        document.getElementById('document').textContent = data.document;
        document.getElementById('fee').textContent = fee;
        document.getElementById('paymentMethod').textContent = data.paymentMethod;
        document.getElementById('paymentMethod').textContent = paymentMethod;
        const paymentProofDisplay = document.getElementById('paymentProof');
        if (data.paymentProof) {
          paymentProofDisplay.innerHTML = `<img class="payment" src="${data.paymentProof}">`;
        } else {
          paymentProofDisplay.innerHTML = 'No payment proof available.';
        }
        document.getElementById('overlay').style.display = 'block';
      })
      .catch(error => console.error('Error fetching details:', error));
  }
  
  function closeOverlay() {
    document.getElementById('overlay').style.display = 'none';
  }