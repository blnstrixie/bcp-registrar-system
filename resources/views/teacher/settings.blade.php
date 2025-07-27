<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6cbb66e0e0.js" crossorigin="anonymous"></script>
    <link rel="icon" href="/icons/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/icons/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/general.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">

    <title> Settings </title>
  </head>

  <body>
    @include('partials/teacher-header')
    @include('partials/teacher-sidebar')

    <main class="container">
      <div class="tabs">
        <!-- Profile Tab -->
        <input type="radio" name="tabs" id="tab1" checked>
        <label for="tab1"> Profile </label>

        <!-- Account Tab -->
        <input type="radio" name="tabs" id="tab2">
        <label for="tab2"> Account </label>

        <!-- Profile Tab Content -->
        <div class="tab-content" id="tab1-content">
          <form action="" class="form" method="POST" enctype="multipart/form-data" id="profileForm">
            
            <div class="tab-content-container">
              <div class="content-title">
                Edit Profile <i span class="fa-solid fa-pen-to-square"></i>
              </div>
        
              <div class="profile-upload">
                  <img class="profile-picture" id="profilePicture1" src="{{ asset('images/anya.jpg') }}">
              
                <div class="right-profile">
                  <div class="upload-text">
                    Upload Profile Picture
                  </div>
              
                  <div class="upload-support">
                    We support JPGs and PNGs under 10MB
                  </div>
              
                  <button type="button" class="upload-btn" onclick="triggerFileInput('fileInput1')"> 
                    <i class="fa-solid fa-cloud-arrow-up"></i> Upload
                  </button>
                  <input class="upload-btn" type="file" name="avatar" id="fileInput1" onchange="updateProfilePicture('fileInput1', 'profilePicture1')">
                </div>
              </div>     
        
              <div class="input-pair">
                <div class="input-group">
                  <div class="settings-label"> First Name </div>
                  <input type="text" name="firstname" id="firstname" autocomplete="on" value="Catherine">
                </div>
        
                <div class="input-group">
                  <div class="settings-label"> Last Name </div>
                  <input type="text" name="lastname" id="lastname" autocomplete="on" value="Francisco">
                </div>
              </div>
        
              <div class="input-pair">
                <div class="input-group">
                  <div class="settings-label"> Middle Name </div>
                  <input type="text" name="middlename" id="middlename" autocomplete="on" value="">
                </div>
        
                <div class="input-group">
                  <div class="settings-label"> Suffix </div>
                  <input type="text" name="suffix" id="suffix-name" autocomplete="on" value="">
                </div>
              </div>
            </div>
        
            <div class="buttons">
              <button class="cancel-btn"> Cancel </button>
              <button class="save-btn" type="submit" id="saveButton" disabled> Save </button>
            </div>
          </form>
        </div>
        
        <script>
          const form = document.getElementById('profileForm');
          const inputs = form.querySelectorAll('input[type="text"]');
          const fileInput = document.getElementById('fileInput1');
          const saveButton = document.getElementById('saveButton');
      
          function checkChanges() {
            let changed = false;
            inputs.forEach(input => {
              if (input.value !== input.defaultValue) {
                changed = true;
              }
            });
      
            if (fileInput.files.length > 0) {
              changed = true;
            }
      
            saveButton.disabled = !changed;
          }
      
          inputs.forEach(input => {
            input.addEventListener('input', checkChanges);
          });
      
          fileInput.addEventListener('change', checkChanges);
        </script>      

        <!-- Account Tab Content -->
        <div class="tab-content" id="tab2-content">
        <!--
          @if(Session::has('success'))
              <div class="alert alert-success" role="alert">
                  {{ Session::get('success') }}
              </div>
          @endif
          @if(Session::has('error'))
              <div class="alert alert-danger" role="alert">
                  {{ Session::get('error') }}
              </div>
          @endif
        -->
          <form action="" class="form" method="POST" id="profileForm2">
            
          <div class="tab-content-container">
            <div class="content-title">
              Edit Account <i span class="fa-solid fa-pen-to-square"></i>
            </div>

            <div class="input-group">
              <div class="settings-label"> Email Address </div>
              <input type="text" name="email" id="email-address" autocomplete="off" value="catherinefrancisco301@gmail.com">
            </div>

            <div class="content-subtitle">
              Change Password 
            </div>

            <div class="input-pair">
              <div class="input-group">
              <div class="settings-label"> Username </div>
                <input type="text" name="username" id="username" autocomplete="off" value="Catherine">
              </div>

              <div class="input-group">
                <div class="settings-label"> Current Password </div>
                <input type="password" name="current" id="current-password" autocomplete="off">

                <div class="password-visibility" id="current-password-icon">
                  <i class="fa-solid fa-eye"></i>
                </div>
              </div>
            </div>

            <div class="input-pair">
              <div class="input-group">
                <div class="settings-label"> New Password </div>
                <input type="password" name="new-password" id="password" autocomplete="off">

                <div class="password-visibility" onclick="togglePasswordVisibility('password', this)">
                  <i class="fa-solid fa-eye"></i>
                </div>
              </div>

              <div class="input-group">
                <div class="settings-label"> Confirm Password </div>
                <input type="password" name="confirm-password" id="confirm-password" oninput="checkPasswordMatch()" autocomplete="off">

                <div class="password-visibility" onclick="togglePasswordVisibility('confirm-password', this)">
                  <i class="fa-solid fa-eye"></i>
                </div>
              </div>
            </div>

            <div id="password-match-message" class="password-match-message">
            </div>
          </div>

          <div class="buttons">
            <button class="cancel-btn"> Cancel </button>

            <button class="save-btn" disabled> Save </button>
          </div>
          </form>
        </div>
        <script>
          const form2 = document.getElementById('profileForm2');
          const inputs2 = form2.querySelectorAll('input[type="text"], input[type="password"]');
          const saveButton2 = form2.querySelector('.save-btn');
          const currentPasswordInput = form2.querySelector('#current-password');
          const newPasswordInput = form2.querySelector('#password');
          const confirmPasswordInput = form2.querySelector('#confirm-password');
        
          function checkChangesForm2() {
            let changed2 = false;
            inputs2.forEach(input => {
              if (input.value !== input.defaultValue) {
                changed2 = true;
              }
            });
        
            const currentPassword = currentPasswordInput.value;
            const newPassword = newPasswordInput.value;
            const confirmPassword = confirmPasswordInput.value;
        
            const passwordsMatch = newPassword === confirmPassword;
            const currentPasswordNotEmpty = currentPassword.trim() !== '';
        
            saveButton2.disabled = !changed2 || !passwordsMatch || !currentPasswordNotEmpty;
          }
        
          function checkPasswordMatch() {
            const newPassword = newPasswordInput.value;
            const confirmPassword = confirmPasswordInput.value;
        
            const passwordsMatch = newPassword === confirmPassword;
        
            const message = document.getElementById('password-match-message');
            if (!passwordsMatch) {
              message.textContent = 'Passwords do not match';
              saveButton2.disabled = true;
            } else {
              message.textContent = '';
              checkChangesForm2();
            }
          }
        
          function checkCurrentPassword() {
            const currentPassword = currentPasswordInput.value;
        
            checkChangesForm2();
          }
        
          inputs2.forEach(input => {
            input.addEventListener('input', checkChangesForm2);
          });
        
          currentPasswordInput.addEventListener('input', checkCurrentPassword);
          newPasswordInput.addEventListener('input', checkPasswordMatch);
          confirmPasswordInput.addEventListener('input', checkPasswordMatch);
        
          form2.addEventListener('change', checkChangesForm2);
        </script>
      </div>
    </main>

    <script src="{{ asset('js/selected-nav-label.js') }}"></script>
    <script src="{{ asset('js/password-visibility.js') }}"></script>
    <script src="{{ asset('js/password.js') }}"></script>
    <script src="{{ asset('js/upload-profile.js') }}"></script>  
  </body>
</html>