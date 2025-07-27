document.getElementById("submissionForm").addEventListener("submit", function(event) {
  event.preventDefault();

  const documentText = document.getElementById("documentText").value;

  if (documentText.trim() === "") {
    
    return;
  }

  const currentDate = new Date();
  const formattedDate = `${currentDate.toLocaleDateString()} ${currentDate.toLocaleTimeString()}`;

  const documentContainer = document.createElement("div");
  documentContainer.classList.add("document-container");

  const documentDetails = document.createElement("p");
  documentDetails.classList.add("document-details");
  documentDetails.innerHTML = `You requested <strong> ${documentText} </strong><br><em>Posted on: ${formattedDate}</em>`;

  const deleteButton = document.createElement("button");
  deleteButton.classList.add("trash-btn");
  deleteButton.innerHTML = `<i class="fa-solid fa-trash"></i>`;
  deleteButton.onclick = function() {

    documentContainer.remove();
  };

  documentContainer.appendChild(documentDetails);
  documentContainer.appendChild(deleteButton);

  document.getElementById("postedDocuments").appendChild(documentContainer);

  document.getElementById("documentText").value = "";

  document.getElementById("submitButton").disabled = false;
});

document.getElementById("documentText").addEventListener("input", function() {
  document.getElementById("submitButton").disabled = this.value.trim() === "";
});
