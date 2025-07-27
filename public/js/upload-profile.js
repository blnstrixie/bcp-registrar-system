function triggerFileInput(fileInputId) {
  const fileInput = document.getElementById(fileInputId);
  fileInput.click(); 
}

function updateProfilePicture(fileInputId, profilePictureId) {
  const fileInput = document.getElementById(fileInputId);
  const profilePicture = document.getElementById(profilePictureId);

  if (fileInput.files && fileInput.files[0]) {
    const reader = new FileReader();

    reader.onload = function (e) {
      profilePicture.src = e.target.result;
    };

    reader.readAsDataURL(fileInput.files[0]);
  }
}