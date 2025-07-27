function toggleStartProcessOverlay() {
  var overlay = document.getElementById('startprocess-overlay');
  overlay.style.display = (overlay.style.display === 'none' || overlay.style.display === '') ? 'block' : 'none';
}

function toggleProcessOverlay(requestId) {
  var overlayId = "startprocess-overlay-" + requestId;
  var overlay = document.getElementById(overlayId);
  if (overlay.style.display === "none") {
    overlay.style.display = "block";
  } else {
    overlay.style.display = "none";
  }
}