document.addEventListener('DOMContentLoaded', function () {
  var passwordInput = document.getElementById('password');
  var seePasswordIcon = document.querySelector('.password-visibility i');

  document.querySelector('.password-visibility').addEventListener('click', function () {
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      seePasswordIcon.classList.remove('fa-eye');
      seePasswordIcon.classList.add('fa-eye-slash');
    } else {
      passwordInput.type = 'password';
      seePasswordIcon.classList.remove('fa-eye-slash');
      seePasswordIcon.classList.add('fa-eye');
    }
  });
});
