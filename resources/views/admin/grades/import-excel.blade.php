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

    <!-- Latest compiled and minified CSS --><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title> Grades </title>
  </head>

  <body>
    @include('partials/registrar-header')
    @include('partials/registrar-sidebar')

    <main class="container">
        <a href="{{ route('registrar/grades') }}" type="button" class="btn btn-secondary mb-3">Back to Grades</a>
        @if(Session::has('message'))
            <div class="alert {{ Session::get('alert-bg') }}" style="color: white;">
                <p class="mt-0 mb-0">{{ Session::get('message') }}</p>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">Import Grades via Excel</h5>
            </div>
            <div class="card-body">
                <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                    <p>1. Download the template file. Click FILE: <a href="{{ route('grades-excel-template') }}"><strong>[template-excel-bcp-grades.xlsx]</strong></a>  to download.</p>
                    <p>2. Once downloaded, fill it with correct data. DO NOT EDIT THE HEADER TITLE OF EXCEL.</p>
                    <p>3. After filled the downloaded file, upload it in the form below and submit</p>
                    <br>
                    <p>
                        <strong>
                            Note: Make sure that rows from excel are updated.
                        </strong>
                    </p>
                    <br>
                </div>
                <form action="{{ route('grades-import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mt-3">
                        <label for="exampleFormControlFile1">Upload Excel File <span style="color: red">*</span></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="grades_file">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                            <br>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Import</button>
                </form>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="../js/selected-nav-label.js"></script>
    <script>

        $('#customFile').on('change',function(){
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
    </script>
  </body>
</html>
