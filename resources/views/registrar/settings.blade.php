<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6cbb66e0e0.js" crossorigin="anonymous"></script>
    <link rel="icon" href="../icons/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../icons/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/table.css">
    <link rel="stylesheet" href="../css/overlay.css">
    
    <title> Settings </title>
  </head>

  <body>
    @include('partials/registrar-header')
    @include('partials/registrar-sidebar')

    <main class="container">
      <div class="tabs">
        <!-- Profile Tab -->
        <input type="radio" name="tabs" id="tab1" checked>
        <label for="tab1"> Profile </label>

        <!-- Account Tab -->
        <input type="radio" name="tabs" id="tab2">
        <label for="tab2"> Account </label>

        
        <!-- Registrar Users Tab -->
        <!--
          <input type="radio" name="tabs" id="tab3">
          <label for="tab3"> Registrar Users </label> 
        -->

        <!-- Maintenance for Document Request Tab -->
        <input type="radio" name="tabs" id="tab4">
        <label for="tab4"> Maintenance for Document Request </label> 

        <!-- Profile Tab Content -->
        <div class="tab-content" id="tab1-content">
          <form action="{{ route('profile', ['id' => $user->id]) }}" class="form" method="POST" enctype="multipart/form-data" id="profileForm">
            @csrf
            <div class="tab-content-container">
              <div class="content-title">
                Edit Profile <i span class="fa-solid fa-pen-to-square"></i>
              </div>
        
              <div class="profile-upload">
                @if($user->avatar)
                  <img class="profile-picture" id="profilePicture1" src="{{ asset($user->avatar) }}">
                @else
                  <img class="profile-picture" id="profilePicture1" src="{{ asset('images/sawako.jpg') }}">
                @endif
              
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
                  <input type="text" name="firstname" id="firstname" autocomplete="on" value="{{ $user->firstname }}">
                </div>
        
                <div class="input-group">
                  <div class="settings-label"> Last Name </div>
                  <input type="text" name="lastname" id="lastname" autocomplete="on" value="{{ $user->lastname }}">
                </div>
              </div>
        
              <div class="input-pair">
                <div class="input-group">
                  <div class="settings-label"> Middle Name </div>
                  <input type="text" name="middlename" id="middlename" autocomplete="on" value="{{ $user->middlename }}">
                </div>
        
                <div class="input-group">
                  <div class="settings-label"> Suffix </div>
                  <input type="text" name="suffix" id="suffix-name" autocomplete="on" value="{{ $user->suffix }}">
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
          <form action="{{ route('account', ['id' => $user->id]) }}" class="form" method="POST" id="profileForm2">
            @csrf
          <div class="tab-content-container">
            <div class="content-title">
              Edit Account <i span class="fa-solid fa-pen-to-square"></i>
            </div>

            <div class="input-group">
              <div class="settings-label"> Email Address </div>
              <input type="text" name="email" id="email-address" autocomplete="off" value="{{ $user->emailAdd }}">
            </div>

            <div class="content-subtitle">
              Change Password 
            </div>

            <div class="input-pair">
              <div class="input-group">
              <div class="settings-label"> Username </div>
                <input type="text" name="username" id="username" autocomplete="off" value="{{ $user->username }}">
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
        
            // Check if both passwords match and current password is not empty
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
        
            // Here, you might want to send an AJAX request to the server to check the current password against the database
            // For simplicity, let's assume the current password check is handled on the server side
        
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
        
        <!-- Registrar Users Tab Content -->
        <!--
        <div class="tab-content" id="tab3-content">
            <div class="content-title">
              Registrar Users <i span class="fa-solid fa-pen-to-square"></i>
            </div>

            <div class="search-row">
              <div class="search-bar" id="search-bar-settings">
                <input type="text" name="search-box" id="search" placeholder="Search"/>

                <button class="search-btn">
                  <i class="fa-solid fa-magnifying-glass"></i>
                </button>
              </div>
            </div>

            <button class="add-user-btn" onclick="Overlay()">
              Add User <i class="fa-solid fa-user-plus"></i>
            </button>

            <div id="overlay" class="overlay">
              <div class="overlay-content">
                <button class="close-btn" onclick="Overlay()">&times;</button>

                <div class="form">
                  <div class="content-title">
                    Add User
                  </div>
                  
                  // Start FORM 
                  <form action="{{ route('store') }}" class="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="studentNum" id="studentNum" autocomplete="off" value="{{ $totalUsers }}" hidden>
                    <input type="text" name="role" id="role" autocomplete="off" value="Registrar" hidden>
                  <div class="input-pair">
                    <div class="input-group">
                      <div class="settings-label"> First Name </div>
                      <input type="text" name="firstname" id="firstname" autocomplete="off">
                    </div>

                    <div class="input-group">
                      <div class="settings-label"> Last Name </div>
                      <input type="text" name="lastname" id="lastname" autocomplete="off">
                    </div>
                  </div>

                  <div class="input-pair">
                    <div class="input-group">
                      <div class="settings-label"> Middle Name </div>
                      <input type="text" name="middlename" id="middlename" autocomplete="off">
                    </div>

                    <div class="input-group">
                      <div class="settings-label"> Suffix </div>
                      <input type="text" name="suffix-name" id="sufix-name" autocomplete="off">
                    </div>
                  </div>

                  <div class="input-pair">
                    <div class="input-group">
                      <div class="settings-label"> Email Address </div>
                      <input type="text" name="emailAdd" id="email" autocomplete="off">
                    </div>

                    <div class="input-group">
                      <div class="settings-label"> Username </div>
                      <input type="text" name="username" id="username" autocomplete="off">
                    </div>
                  </div>

                  <div class="input-pair">
                    <div class="input-group">
                      <div class="settings-label"> Password </div>
                      <input type="password" name="password" id="password-1" autocomplete="off">

                      <div class="password-visibility" onclick="togglePasswordVisibility('password-1', this)">
                        <i class="fa-solid fa-eye"></i>
                      </div>
                    </div>

                    <div class="input-group">
                      <div class="settings-label"> Confirm Password </div>
                      <input type="password" name="confirm-password" id="confirm-password-1" oninput="checkPasswordMatch()" autocomplete="off">

                      <div class="password-visibility" onclick="togglePasswordVisibility('confirm-password-1', this)">
                        <i class="fa-solid fa-eye"></i>
                      </div>
                    </div>
                  </div>

                  <div id="password-match-message-1" class="password-match-message">
                  </div>

                  <div class="profile-upload" id="profile-upload">
                    <img class="profile-picture" id="profilePicture2" src="{{ asset('images/avatar.jpg') }}">

                    <div class="right-profile">
                      <div class="upload-text">
                        Upload Profile Picture
                      </div>

                      <div class="upload-support">
                        We support JPGs and PNGs under 10MB
                      </div>

                      <button class="upload-btn" onclick="triggerFileInput('fileInput2')">
                        <i class="fa-solid fa-cloud-arrow-up"></i> Upload
                      </button>

                      <input type="file" id="fileInput2" onchange="updateProfilePicture('fileInput2', 'profilePicture2')">
                    </div>
                  </div>
                </div>

                <div class="buttons" id="buttons">
                  <button class="cancel-btn"> Cancel </button>
                  <button class="save-btn" type="submit"> Save </button>
                </div>
                </form>
                // END FORM
              </div>
            </div>
            
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
            <table>
              <thead>
                <tr>
                  <th scope="col"> Name </th>
                  <th scope="col"> Username </th>
                  <th scope="col"> Email </th>
                  <th scope="col"> Date Created </th>
                  <th scope="col"> Action </th>
                </tr>
              </thead>
              <tbody id="myTable">
                @php
                    $foundResults = false;
                @endphp
                @foreach($users as $reg)
                    @if($reg->role === 'Registrar')
                        @php
                            $foundResults = true;
                        @endphp
                        <tr>
                            <td data-label="Name">{{ $reg->firstname }} {{ $reg->middlename }} {{ $reg->lastname }}</td>
                            <td data-label="Username">{{ $reg->username }}</td>
                            <td data-label="Email">{{ $reg->emailAdd }}</td>
                            <td data-label="Date Created">{{ $reg->created_at }}</td>
                            <td data-label="Action">
                                <button class="trash-btn" onclick="regConfirmation(event, {{ $reg->id }})">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endif
                @endforeach
              </tbody>
              <tr id="noResults" style="display: {{ $foundResults ? 'none' : 'table-row' }}">
                <td colspan="5">No Results Found</td>
              </tr>
            </table>
            @include('partials/delete-overlay')
          </div> 
        -->

          <!-- Maintenance Tab Content -->
          <div class="tab-content" id="tab4-content">
            <div class="content-title">
              Documents Available for Requests
            </div>

            <button class="add-user-btn" id="" onclick="toggleStartProcessOverlay()">
              Add Document <i class="fa-solid fa-plus"></i>
            </button>

            <div id="startprocess-overlay" class="overlay">
              <div class="overlay-content">
                <button class="close-btn" onclick="toggleStartProcessOverlay()">&times;</button>

                <div class="form">
                  <form action="{{ route('documents') }}" class="form" method="POST">
                    @csrf
                  <div class="content-title">
                    Add Document Available for Request
                  </div>
                      
                  <div class="input-group">
                    <div class="settings-label"> Document </div>
                    <input type="text" name="document_name" id="document" autocomplete="off">
                  </div>

                  <div class="input-group">
                    <div class="settings-label"> Fee </div>
                    <input type="text" name="fee" id="fee" autocomplete="off">
                  </div>

                  <div class="buttons" id="buttons">
                    <button class="cancel-btn"> Cancel </button>

                    <button class="save-btn" type="submit"> Save </button>
                  </div>
                  </form>
                </div>
              </div>
            </div>

            <table class="document-tbl">
              <thead>
                <tr>
                  <th scope="col"> Document </th>
                  <th scope="col"> Fee </th>
                  <th scope="col"> Action </th>
                </tr>
              </thead>
              <tbody>
                @foreach($documents as $document)
                <tr>
                  <td data-label="Document"> {{ $document->document_name }} </td>
                  <td data-label="Fee"> {{ $document->fee }} Pesos </td>
                  <td data-label="Action">
                    <button class="trash-btn" onclick="docsConfirmation(event, {{ $document->id }})">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>

            <div class="content-title">
              Payment Method
            </div>

            <button class="add-user-btn" id="" onclick="PaymentMethodOverlay()">
              Add Payment Method <i class="fa-solid fa-plus"></i>
            </button>

            <div id="paymentmethod-overlay" class="overlay">
              <div class="overlay-content">
                <button class="close-btn" onclick="PaymentMethodOverlay()">&times;</button>

                <div class="form">
                  <form action="{{ route('method') }}" class="form" method="POST" enctype="multipart/form-data">
                    @csrf
                  <div class="content-title">
                    Add Payment Method
                  </div>
                      
                  <div class="input-group">
                    <div class="settings-label"> Payment Method </div>
                    <input type="text" name="payment_method" id="payment-method" autocomplete="off">
                  </div>

                  <div class="input-group">
                    <div class="settings-label"> QR Code </div>
                    <input type="file" name="qr_code" id="qr-code">
                  </div>

                  <div class="buttons" id="buttons">
                    <button class="cancel-btn"> Cancel </button>

                    <button class="save-btn" type="submit"> Save </button>
                  </div>
                  </form>
                </div>
              </div>
            </div>

            <table>
              <thead>
                <tr>
                  <th scope="col"> Payment Method </th>
                  <th scope="col"> QR Code </th>
                  <th scope="col"> Action </th>
                </tr>
              </thead>
              <tbody>
                @foreach( $paymentmethod as $method )
                <tr>
                  <td data-label="Document"> {{ $method->payment_method }} </td>
                  <td data-label="Fee">
                    <!-- <span class="paymentmethod"> $method->qr_code </span> -->
                    @if($method->qr_code)
                        <img class="qr-code" src="{{ asset($method->qr_code) }}">
                    @else
                        <span>No QR code available</span>
                    @endif
                </td>
                  <td data-label="Action">
                    <button class="trash-btn" onclick="methodConfirmation(event, {{ $method->id }})">
                      <i class="fa-solid fa-trash"></i>
                    </button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div id="confirmationOverlay" class="overlay" style="display: none;">
          <div class="overlay-content" id="deleteOverlay-content">
              <button class="close-btn" onclick="hideConfirmation()">&times;</button>
              <div class="confirmation-message">
                  <p>Are you sure you want to delete this?</p>
              </div>
      
              <div class="confirmation-buttons">
                  <form action="#" class="form" method="POST" id="confirmDeleteForm">
                      @csrf
                      <button class="delete-btn" onclick="deleteDocs()">
                          Yes
                      </button>
                  </form>
      
                  <button class="cancel-delete-btn" onclick="hideConfirmation()">
                      No
                  </button>
              </div>
          </div>
        </div>
    </main>
    <script>
        let regToDelete = null;
        let docsToDelete = null;
        let mdsToDelete = null;
        

        function regConfirmation(event, regId) {
            event.preventDefault();
            document.getElementById('confirmationOverlay').style.display = 'block';
            regToDelete = regId;
        }

        function docsConfirmation(event, documentId) {
            event.preventDefault();
            document.getElementById('confirmationOverlay').style.display = 'block';
            docsToDelete = documentId;
        }

        function methodConfirmation(event, methodId) {
            event.preventDefault();
            document.getElementById('confirmationOverlay').style.display = 'block';
            mdsToDelete = methodId;
        }
    
        function hideConfirmation() {
            document.getElementById('confirmationOverlay').style.display = 'none';
        }
    
        function deleteDocs() {
          if(regToDelete !== null){
            const confirmDeleteForm = document.getElementById('confirmDeleteForm');
            confirmDeleteForm.action = `/destroyReg/${regToDelete}`;
            confirmDeleteForm.submit();
          }else{
            if (mdsToDelete!==null) {
                const confirmDeleteForm = document.getElementById('confirmDeleteForm');
                confirmDeleteForm.action = `/deleteMethod/${mdsToDelete}`;
                confirmDeleteForm.submit();
            }else{
              if (docsToDelete){
                const confirmDeleteForm = document.getElementById('confirmDeleteForm');
                confirmDeleteForm.action = `/deleteDocs/${docsToDelete}`;
                confirmDeleteForm.submit();
              }
            }
          }
          
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function() {
          $("#search").on("keyup", function() {
              var value = $(this).val().toLowerCase();
              var found = false;
              $("#myTable tr").filter(function() {
                  var currentRow = $(this).text().toLowerCase();
                  var match = currentRow.indexOf(value) > -1;
                  $(this).toggle(match);
                  if (match) {
                      found = true;
                  }
              });
              $("#noResults").toggle(!found);
          });
      });
    </script>
    <script src="../js/selected-nav-label.js"></script>
    <script src="../js/password-visibility.js" defer></script>
    <script src="../js/password.js" defer></script>
    <script src="../js/overlay.js" defer></script>
    <script src="../js/delete-overlay.js" defer></script>
    <script src="../js/upload-profile.js" defer></script>
    <script src="../js/startprocess-overlay.js" defer></script>
    <script src="../js/payment-method.js" defer></script>    
  </body>
</html>