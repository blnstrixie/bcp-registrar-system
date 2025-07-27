@extends('app')
@section('title', 'Import Grades')

@section('links')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        input[type="file"] {
            display: block;
        }
    </style>
@endsection
@section('page-content')

    <a href="{{ route('grades-list') }}" type="button" class="btn btn-secondary mb-3">Back to Grades</a>
    @if (Session::has('message'))
        <div class="alert {{ Session::get('alert-bg') }}" style="color: white;">
            <p class="mt-0 mb-0">{{ Session::get('message') }}</p>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">Import Grades via Excel</h5>
        </div>
        <div class="card-body">
            <div class="alert"
                style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                <p>1. Download the template file. Click FILE: <a
                        href="{{ route('grades-excel-template') }}"><strong>[template-excel-bcp-grades.xlsx]</strong></a> to
                    download.</p>
                <p>2. Once downloaded, fill it with correct data. DO NOT EDIT THE HEADER TITLE OF EXCEL.</p>
                <p>3. After filled the downloaded file, upload it in the form below and submit</p>
                <br>
                <p>
                    <strong>
                        Note: Make sure that rows from excel are updated.
                    </strong>
                </p>

                <p><code>
                    DEVELOPERS OPTIONS (LOCALHOST):
                    <br>
                    1. Go to php.ini file in C:\xampp\php <br>
                    2. Search this ;extension=gd <br>
                    3. Remove ; then restart the xampp
                </code></p>
            </div>
            <form action="{{ route('grades-import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mt-3">
                    <div class="mb-3">
                        <label for="formFile">Upload Excel File <span style="color: red">*</span></label>
                        <input class="form-control" type="file" id="formFile" name="grades_file" accept=".xlsx, .xls, .csv"/>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Import</button>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

@endsection
