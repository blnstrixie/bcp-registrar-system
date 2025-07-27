<!DOCTYPE html>
<html lang="en">
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
    <link rel="stylesheet" href="{{ asset('css/overlay.css') }}">

    <title> Teacher Users </title>
  </head>

  <body>
      @include('partials/admin-header')
      @include('partials/admin-sidebar')

    <main>
      <div class="content-title">
              Teacher Users <i span class="fa-solid fa-pen-to-square"></i>
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
                  
                  <!-- Start FORM --->
                  <form action="" class="form" method="POST" enctype="multipart/form-data">

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
                      <div class="settings-label"> New Password </div>
                      <input type="password" name="password" id="password" autocomplete="off">

                      <div class="password-visibility" onclick="togglePasswordVisibility('password', this)">
                        <i class="fa-solid fa-eye"></i>
                      </div>
                    </div>

                    <div class="input-group">
                      <div class="settings-label"> Confirm Password </div>
                      <input type="password" name="confirm-password" id="confirm-password" oninput="checkPasswordMatch()" autocomplete="off">

                      <div class="password-visibility" onclick="togglePasswordVisibility('confirm-password', this)">
                        <i class="fas fa-eye"></i>
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
                  <button class="save-btn" type="submit"> Save </button>
                </div>
                </form>
                <!-- END FORM --->
              </div>
            </div>
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
                        <tr>
                            <td data-label="Name">Catherine Francisco</td>
                            <td data-label="Username">Cathy</td>
                            <td data-label="Email">catherinefrancisco301@gmail.com</td>
                            <td data-label="Date Created">12/12/2023</td>
                            <td data-label="Action">
                                <button class="trash-btn">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
              </tbody>
            </table>
          </div> 
    </main>

    <script src="{{ asset('js/selected-nav-label.js') }}"></script>
    <script src="{{ asset('js/password-visibility.js') }}" defer></script>
    <script src="{{ asset('js/password.js') }}" defer></script>
    <script src="{{ asset('js/overlay.js') }}" defer></script>
  </body>
</html>