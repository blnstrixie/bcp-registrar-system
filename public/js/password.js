function togglePasswordVisibility(inputId, iconElement) {
  const passwordInput = document.getElementById(inputId);

  if (passwordInput.type === 'password') {
    passwordInput.type = 'text';
    iconElement.innerHTML = '<i class="fas fa-eye-slash"></i>';
  } else {
    passwordInput.type = 'password';
    iconElement.innerHTML = '<i class="fas fa-eye"></i>';
  }
}

function checkPasswordMatch() {
  const password = document.getElementById('password').value;
  const confirmPassword = document.getElementById('confirm-password').value;
  const saveButton = document.querySelector('.save-btn');

  const passwordMatchMessage = document.getElementById('password-match-message');

  if (password !== confirmPassword) {
      passwordMatchMessage.innerHTML = "Passwords do not match";
      saveButton.disabled = true;
  } else {
      passwordMatchMessage.innerHTML = "";
      saveButton.disabled = false;
  }
}
