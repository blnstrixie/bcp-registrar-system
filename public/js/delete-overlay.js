function showDeleteConfirmation() {
  var deleteOverlay = document.getElementById('deleteOverlay');
  deleteOverlay.style.display = 'block';

  var row = document.querySelector('tr[data-delete-confirm="true"]');
  if (row) {
    row.removeAttribute('data-delete-confirm');
  }

  var currentRow = event.target.closest('tr');
  if (currentRow) {
    currentRow.setAttribute('data-delete-confirm', 'true');
  }
}

function hideDeleteConfirmation() {
  var deleteOverlay = document.getElementById('deleteOverlay');
  deleteOverlay.style.display = 'none';
}

function deleteUser() {
  var table = document.querySelector('table tbody');
  var rowToDelete = document.querySelector('tr[data-delete-confirm="true"]');

  if (rowToDelete) {
    table.removeChild(rowToDelete);
  }

  hideDeleteConfirmation();
}

document.querySelector('.cancel-delete-btn').addEventListener('click', hideDeleteConfirmation);
