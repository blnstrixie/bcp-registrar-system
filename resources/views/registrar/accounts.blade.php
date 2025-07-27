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
        <!-- Account Validation Tab -->
        <input type="radio" name="tabs" id="tab1" checked>
        <label for="tab1"> Account Validation </label>

        <!-- Student Users Tab -->
        <input type="radio" name="tabs" id="tab2">
        <label for="tab2"> Student Users </label> 

        <!-- Account Validation Tab Content -->
        <div class="tab-content" id="tab1-content">
          <div class="tab-content-container">
            <div class="content-title">
              Student Accounts 
            </div>

            <div class="subtitle">
              Approve or reject student-created accounts.
            </div>
            @if(Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif
            <table>
              <thead>
                <tr>
                  <th scope="col">Name</th>
                  <th scope="col">Username</th>
                  <th scope="col">Email</th>
                  <th scope="col">Date Created</th>
                  <th scope="col">Matched Student</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $studs)
                    @if($studs->role === 'Student' || $studs->role === null)
                        <tr>
                            <td data-label="Name">{{ $studs->firstname }} {{ $studs->middlename }} {{ $studs->lastname }}</td>
                            <td data-label="Username">{{ $studs->username }}</td>
                            <td data-label="Email">{{ $studs->emailAdd }}</td>
                            <td data-label="Date Created">{{ $studs->created_at }}</td>
                            <td data-label="Matched Student">
                                @if($studs->student)
                                    {{ $studs->student->student_no }} - {{ $studs->student->firstname }} {{ $studs->student->middlename }} {{ $studs->student->lastname }} {{ $studs->student->suffix }}
                                @else
                                    None
                                @endif
                            </td>
                            <td data-label="Action">
                                @if($studs->role !== 'Student')
                                    <div class="action-btns">
                                        <form action="{{ route('accept', ['id' => $studs->id]) }}" class="form" method="POST">
                                            @csrf
                                            <button class="edit-btn">
                                                Accept
                                            </button>
                                        </form>
                                        <form action="{{ route('reject', ['id' => $studs->id]) }}" class="form" method="POST">
                                            @csrf
                                            <button class="trash-btn">
                                                <i class="fa-solid fa-x"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>                     
            </table>
          </div>
        </div>
        
        <!-- Student Users Tab Content -->
        <div class="tab-content" id="tab2-content">
          <div class="content-title">
            Student Users <i span class="fa-solid fa-pen-to-square"></i>
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
                <form action="{{ route('storeStud') }}" class="form" method="POST" enctype="multipart/form-data">
                  @csrf
                  <input type="text" name="role" id="role" autocomplete="off" value="Student" hidden>
                <div class="input-pair">
                  <div class="input-group">
                    <div class="settings-label"> First Name </div>
                    <input type="text" name="firstname" id="firstname" autocomplete="off" oninput="checkFields()">
                  </div>

                  <div class="input-group">
                    <div class="settings-label"> Last Name </div>
                    <input type="text" name="lastname" id="lastname" autocomplete="off" oninput="checkFields()">
                  </div>
                </div>

                <div class="input-pair">
                  <div class="input-group">
                    <div class="settings-label"> Middle Name </div>
                    <input type="text" name="middlename" id="middlename" autocomplete="off">
                  </div>

                  <div class="input-group">
                    <div class="settings-label"> Suffix </div>
                    <input type="text" name="suffix" id="sufix-name" autocomplete="off">
                  </div>
                </div>

                <div class="input-pair">
                  <div class="input-group">
                    <div class="settings-label"> Student Number </div>
                    <select name="studentNum" id="student-no">
                      <option disabled selected> Select Student Number </option>
                      @foreach($studentNum as $Num)
                        <option value="{{ $Num->student_no }}"> {{ $Num->student_no }} </option> 
                      @endforeach
                    </select>
                  </div>
  
                  <div class="input-group">
                    <div class="settings-label"> Year Level </div>
                    <select name="yearlevel_id" id="year-level">
                      <option disabled selected> Select Year Level </option>
                      @foreach($YearLevels as $Levels)
                        <option value="{{ $Levels->id }}"> {{ $Levels->year_levels }} ({{ $Levels->course->program }}) </option> 
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="input-pair">
                  <div class="input-group">
                    <div class="settings-label"> Email Address </div>
                    <input type="text" name="emailAdd" id="email" autocomplete="off" oninput="checkFields()">
                  </div>

                  <div class="input-group">
                    <div class="settings-label"> Username </div>
                    <input type="text" name="username" id="username" autocomplete="off" oninput="checkFields()">
                  </div>
                </div>

                <div class="input-pair">
                  <div class="input-group">
                    <div class="settings-label"> Password </div>
                    <input type="password" name="password" id="password" autocomplete="off" oninput="checkFields()">

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

                <button class="save-btn" disabled> Save </button>
              </div>
              </form>
            </div>
          </div>
          <script>
            function checkFields() {
                const firstname = document.getElementById('firstname').value;
                const lastname = document.getElementById('lastname').value;
                const email = document.getElementById('email').value;
                const username = document.getElementById('username').value;
                const password = document.getElementById('password').value;
                const saveButton = document.querySelector('.save-btn');
        
                if (firstname.trim() !== '' && lastname.trim() !== '' && email.trim() !== '' && username.trim() !== '' && password.trim() !== ''  ) {
                    saveButton.disabled = false;
                } else {
                    saveButton.disabled = true;
                }
            }
        
            // Call checkFields() when any of the required fields change
            const requiredFields = document.querySelectorAll('#firstname, #lastname, #email, #username, #password');
            requiredFields.forEach(field => {
                field.addEventListener('input', checkFields);
            });
          </script>        
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
                @foreach($users as $studs)
                    @if($studs->role === 'Student')
                        @php
                            $foundResults = true;
                        @endphp
                        <tr>
                            <td data-label="Name">{{ $studs->firstname }} {{ $studs->middlename }} {{ $studs->lastname }}</td>
                            <td data-label="Username">{{ $studs->username }}</td>
                            <td data-label="Email">{{ $studs->emailAdd }}</td>
                            <td data-label="Date Created">{{ $studs->created_at }}</td>
                            <td data-label="Action">
                                <button class="trash-btn" onclick="studConfirmation(event, {{ $studs->id }})">
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
      </div>
    </main>
    <script>
        let studToDelete = null;
        
        function studConfirmation(event, studId) {
            event.preventDefault();
            document.getElementById('confirmationOverlay').style.display = 'block';
            studToDelete = studId;
        }
    
        function hideConfirmation() {
            document.getElementById('confirmationOverlay').style.display = 'none';
        }
    
        function deleteDocs() {
          if(studToDelete !== null){
            const confirmDeleteForm = document.getElementById('confirmDeleteForm');
            confirmDeleteForm.action = `/deleteStud/${studToDelete}`;
            confirmDeleteForm.submit();
          }
        }
    </script>
    <!-- Your scripts -->
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
    <script>
      $('#student-no').change(function() {
          var selectedStudentNum = $(this).val();

          $.ajax({
              url: '/get-student-info/' + selectedStudentNum,
              type: 'GET',
              success: function(response) {
                  $('#firstname').val(response.firstname);
                  $('#lastname').val(response.lastname);
                  $('#middlename').val(response.middlename);
                  $('#suffix').val(response.suffix);
                  $('#email').val(response.email);

              },
              error: function(xhr, status, error) {
                  // Handle error here
                  console.error(error);
              }
          });
      });
    </script>
    <script src="../js/selected-nav-label.js"></script>
    <script src="../js/password-visibility.js" defer></script>
    <script src="../js/password.js" defer></script>
    <script src="../js/overlay.js" defer></script>
    <script src="../js/delete-overlay.js" defer></script>
    <script src="../js/upload-profile.js" defer></script>    
  </body>
</html>