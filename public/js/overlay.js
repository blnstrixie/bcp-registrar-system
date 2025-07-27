function Overlay() {
  var overlay = document.getElementById('overlay');
  overlay.style.display = (overlay.style.display === 'none' || overlay.style.display === '') ? 'block' : 'none';
}

function toggleOverlay(currentItemID) {
  fetch(`/get-details/${currentItemID}`)
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
      document.getElementById('paymentMethod').textContent = paymentMethod;
      const paymentProofDiv = document.getElementById('paymentProof');
      const proofOfPaymentLink = document.createElement('a');
      proofOfPaymentLink.textContent = 'Proof of Payment';
      proofOfPaymentLink.target = '_blank';

      if (data.id) {
        const paymentProofUrl = basePaymentProofUrl.replace(':id', data.id);
        proofOfPaymentLink.href = paymentProofUrl;
        paymentProofDiv.innerHTML = ''; // Clear previous content
        paymentProofDiv.appendChild(proofOfPaymentLink);
        console.log(proofOfPaymentLink);
      } else {
        paymentProofDiv.innerHTML = 'No payment proof available';
      }
      document.getElementById('overlay').style.display = 'block';
    })
    .catch(error => console.error('Error fetching details:', error));
}

function closeOverlay() {
  document.getElementById('overlay').style.display = 'none';
}