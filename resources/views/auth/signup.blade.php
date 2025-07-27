<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6cbb66e0e0.js" crossorigin="anonymous"></script>
    <script src="js/progress.js" defer></script>
    <script src="js/password.js" defer></script>
    <script src="js/profile.js" defer></script>
    <link rel="icon" href="icons/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="icons/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/signup.css">
    <link rel="stylesheet" href="css/auth.css">

    <title> Create an account </title>
  </head>
  
  <body>
    <main class="container">
      <section class="left-side">
        <h1 class="title"> 
          Create an account 
        </h1>

        <p class="welcome-text"> 
          This form is for students only 
        </p>
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
        <form action="{{ route('auth/signup') }}" class="form" method="POST" enctype="multipart/form-data">
          @csrf
          <!-- Progress bar -->
          <div class="progress-bar">
            <div class="progress" id="progress"></div>
            
            <div class="progress-step progress-step-active" data-title="Personal"></div>
            <div class="progress-step" data-title="Account"></div>
            <div class="progress-step" data-title="Picture"></div>
          </div>
    
          <!-- Personal Details -->
          <div class="form-step form-step-active">
            <div class="input-group">
              <label for="firstname"> First Name <span class="required"> &#42; </span></label>
              <input type="text" name="firstname" id="firstname" autocomplete="on" required/>
            </div>
  
            <div class="input-group">
              <label for="lastname"> Last Name <span class="required"> &#42; </span></label>
              <input type="text" name="lastname" id="lastname" autocomplete="on" required/>
            </div>
         
            <div class="input-group">
              <label for="middlename"> Middle Name </label>
              <input type="text" name="middlename" id="middlename" autocomplete="on"/>
            </div>
  
            <div class="input-group">
              <label for="suffix"> Suffix </label>
              <input type="text" name="suffix" id="suffix" autocomplete="on"/>
            </div>

            <div class="input-group">
              <label for="student-number"> Student Number <span class="required"> &#42; </span></label>
              <input type="text" name="studentNum" id="student-number" autocomplete="on" required/>
            </div>

            <div class="">
              <a href="#" class="btn btn-next width-50 ml-auto"> 
                Next 
                <i class="fa-solid fa-arrow-right"></i>
              </a>
            </div>
          </div>

          <!-- Account -->
          <div class="form-step">
            <div class="input-group">
              <label for="email-address"> Email Address <span class="required"> &#42; </span></label>
              <input type="text" name="email" id="email-address" autocomplete="off" required/>
              @if($errors->has('email'))
                  <span class="text-danger">{{ $errors->first('email') }}</span>
              @endif
            </div>

            <div class="input-group">
              <label for="username"> Username <span class="required"> &#42; </span></label>
              <input type="text" name="username" id="username" autocomplete="off" required/>
            </div>

              <div class="input-group">
                <label for="password"> Password <span class="required"> &#42; </span></label>
                <input type="password" name="password" id="password" autocomplete="off" required/>

                <div class="password-visibility" onclick="togglePasswordVisibility('password', this)">
                  <i class="fa-solid fa-eye"></i>
                </div>
              </div>
  
              <div class="input-group">
                <label for="confirm-password"> Confirm Password <span class="required"> &#42; </span></label>
                <input type="password" name="confirm-password" id="confirm-password" autocomplete="off" oninput="checkPasswordMatch()" required/>

                <div class="password-visibility" onclick="togglePasswordVisibility('confirm-password', this)">
                  <i class="fa-solid fa-eye"></i>
                </div>
              </div>

            <div id="password-match-message" class="password-match-message">
            </div>

            <div class="buttons">
              <a href="#" class="btn btn-prev">
                <i class="fa-solid fa-arrow-left"></i> 
                Previous
              </a>
              <a href="#" class="btn btn-next"> 
                Next <i class="fa-solid fa-arrow-right"></i>
              </a>
            </div>
          </div>

          <!-- Profile Picture -->
          <div class="form-step">
            <div class="avatar-label"> Upload Display Picture </div>

            <div class="avatar" id="avatar">
              <div id="preview">
                <img src="{{ asset('images/avatar.jpg') }}" id="avatar-image" class="avatar_img">
              </div>

              <div class="avatar_upload">
                <label class="upload_label">
                  <i class="fa-solid fa-camera"></i>
                  <input type="file" name="avatar" id="upload">
                </label>
              </div>
            </div>

            <div class="nickname">
              <span id="name" tabindex="4" data-key="1" contenteditable="true" onkeyup="changeAvatarName(event, this.dataset.key, this.textContent)" onblur="changeAvatarName('blur', this.dataset.key, this.textContent)"></span>
            </div>

            <div class="upload-message">
                You have the option to upload or modify your display picture later within the profile settings.
            </div>

            <div class="buttons">
              <a href="#" class="btn btn-prev">
                <i class="fa-solid fa-arrow-left"></i> 
                Previous
              </a>
              <button class="btn">Submit</button>
            </div>
          </div>
        </form>
      </section>

      <section class="right-side">
        <p class="login-text"> Already have an account&#63; </p>

        <a href="{{ route('auth/login') }}">
          <button class="login-link"> Login </button>
        </a>

        <img class="illustration" src="svg/signin.svg">
      </section>
    </main>
  </body>
</html>