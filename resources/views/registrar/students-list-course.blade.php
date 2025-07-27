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


    <title> Students List per Course </title>
  </head>

  <body>
    @include('partials/registrar-header')
    @include('partials/registrar-sidebar')

    <main class="container">
      <div class="content-title">
        Bachelor of Information System Students
      </div>

      <div class="search-bar">
        <input type="text" name="search" id="search" placeholder="Search"/>

        <button class="search-btn">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
      </div>
      
      <div class="filter-row">
        <div class="filter-label">
          Filter
        </div>

        <div id="dataDisplay" class="select-group">
          <select name="year-level" id="year-level">
            <option selected disabled> Year Level </option>
            <option> 1st Year </option>
            <option> 2nd Year </option>
            <option> 3rd Year </option>
            <option> 4th Year </option>
          </select>

          <select name="section" id="section">
            <option selected disabled> Section </option>
            <option> Bulacan BSIS 1001 </option>
            <option> Bulacan BSIS 2001 </option>
            <option> Bulacan BSIS 3001 </option>
            <option> Bulacan BSIS 4001 </option>
          </select>

          <button id="filterButton" class="filter-btn">
            <i class="fa-solid fa-filter"></i>
          </button>
        </div>
      </div>

      <table>
        <thead>
          <tr>
          <tr>
            <th scope="col"> Student Number </th>
            <th scope="col"> Name </th>
            <th scope="col"> Year Level </th>
            <th scope="col"> Section </th>
            <th scope="col"> Academic Year </th>
          </tr>
          </tr>
        </thead>
        <tbody id="myTable">
            <tr>
              <td data-label="Student Number">2023123456</td>
              <td data-label="Name">Beatrice Gamazon</td>
              <td data-label="Year Level">4th Year</td>
              <td data-label="Section">Bulacan BSIS 4001</td>
              <td data-label="Academic Year">2023-2024</td>
            </tr>
        </tbody>
      </table>
    </main>
    <script src="../js/selected-nav-label.js"></script>
  </body>
</html>