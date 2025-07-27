function editRow(button) {
  var row = button.parentNode.parentNode;

  row.cells[3].contentEditable = true; 
  row.cells[4].contentEditable = true; 
  row.cells[5].contentEditable = true; 

  button.style.display = 'none'; 
  var saveButton = row.querySelector('.save-btn');
  saveButton.style.display = 'inline-block';

  saveButton.addEventListener('click', function() {
    saveRow(row, button, saveButton);
  });
}

function saveRow(row, button) {
  row.cells[3].contentEditable = false; 
  row.cells[4].contentEditable = false; 
  row.cells[5].contentEditable = false; 
  
  const form = row.querySelector('.hidden-form');
  form.querySelector('input[name="prelim_grade"]').value = row.cells[3].innerText.trim();
    form.querySelector('input[name="midterm_grade"]').value = row.cells[4].innerText.trim();
    form.querySelector('input[name="final_grade"]').value = row.cells[5].innerText.trim();
  form.submit();
  
  saveButton.style.display = 'none'; 
  editButton.style.display = 'inline-block';

  editButton.addEventListener('click', function() {
    editRow(editButton);
  });
}

var editButtons = document.getElementsByClassName("edit-btn");
for (var i = 0; i < editButtons.length; i++) {
  editButtons[i].addEventListener("click", function() {
    editRow(this);
  });
}