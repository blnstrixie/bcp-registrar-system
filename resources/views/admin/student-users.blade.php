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

    <title> Student Users </title>
  </head>

  <body>
      @include('partials/admin-header')
      @include('partials/admin-sidebar')

    <main>
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
                            <td data-label="Name">Beatrice Gamazon</td>
                            <td data-label="Username">Trixie</td>
                            <td data-label="Email">trixiebelnas7@gmail.com</td>
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