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
    <link rel="stylesheet" href="{{ asset('css/grid-cards.css') }}">
    <link rel="stylesheet" href="{{ asset('css/general.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">

    <title> Analytics </title>
  </head>

  <body>
      @include('partials/admin-header')
      @include('partials/admin-sidebar')

    <main>
      <div class="top">
        Welcome, Trixie
        
        <p class="top-message">
          Greetings from the BCP Registrar System! You can now manage the accounts of the users.
        </p>
      </div>

      <div class="cards-container">
        <div class="card">
          <i class="fa-solid fa-users"></i>

          <div class="card-stats">
            <p class="number">
              1
            </p>
            <p class="card-label">
              Registrar Users
            </p>
          </div>
        </div>

        <div class="card">
          <i class="fa-solid fa-chalkboard-user"></i>

          <div class="card-stats">
            <p class="number">
              2
            </p>
            <p class="card-label">
              Teacher Users
            </p>
          </div>
        </div>

        <div class="card">
          <i class="fa-solid fa-user-graduate"></i>

          <div class="card-stats">
            <p class="number">
              6
            </p>
            <p class="card-label">
              Student Users
            </p>
          </div>
        </div>
      </div>
    </main>

    <script src="js/selected-nav-label.js" ></script>
  </body>
</html>