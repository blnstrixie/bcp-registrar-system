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

    <style>
        body {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
        }
        
        #fileInput {
            display: none;
        }

        #fileInputLabel {
            cursor: pointer;
            background-color: #f2f7ff;
            color: white;
            padding: 10px 15px;
            border: 2px dashed var(--primary-color);
            border-radius: 10px;
            font-size: 16px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 80vh;
            height: 30vh;
            gap: 10px;
            margin: 20px 0 20px 0;
        }

        #fileInputLabel i {
          font-size: 50px;
          color: var(--primary-color);
        }

        .upload-message {
          color: var(--primary-color);
          font-size: 15px;
        }

        #uploadButton {
            cursor: pointer;
            background-color: #008CBA;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            margin: 0 auto; 
            display: block; 
        }

        #fileList {
            list-style-type: none;
            padding: 0;
            margin-top: 50px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .file-item {
            margin-bottom: 5px;
        }
    </style>

    <title> Upload Grades </title>
  </head>

  <body>
      @include('partials/teacher-header')
      @include('partials/teacher-sidebar')

    <main>
      <input type="file" id="fileInput" accept=".csv, .xlsx" style="display: none;">
      <label for="fileInput" id="fileInputLabel">
        <i class="fa-solid fa-cloud-arrow-up"></i>
        <div class="upload-message"> Select a CSV or XLSX file to upload </div>
      </label>

      <button id="uploadButton" onclick="uploadFiles()">Upload</button>

      <ul id="fileList"></ul>
    </main>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    document.getElementById('fileInput').addEventListener('change', handleFileSelect);

    function handleFileSelect() {
    const fileInput = document.getElementById('fileInput');
    const uploadMessage = document.querySelector('.upload-message');

    if (fileInput.files.length > 0) {
        const fileName = fileInput.files[0].name;
        uploadMessage.innerHTML = `Selected file: <strong>${fileName}</strong>`;
        $('#uploadButton').show();
    }
}

function uploadFiles() {
    const fileList = document.getElementById('fileInput').files;

    if (fileList.length > 0) {
        const fileListElement = document.getElementById('fileList');
        const uploadMessage = document.querySelector('.upload-message');

        const formData = new FormData();
        formData.append('file', fileList[0]);

        $.ajax({
            url: '/upload-endpoint',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
            },
            error: function (error) {
                console.error(error);
            },
            complete: function () {
                $('#fileInput').val('');
                //$('#uploadButton').hide();

                // Reset the upload message
                uploadMessage.innerHTML = 'Select a CSV or XLSX file to upload';
            }
        });

        Array.from(fileList).forEach(file => {
            const listItem = document.createElement('li');
            listItem.className = 'file-item';

            const fileName = document.createElement('span');
            fileName.textContent = file.name;

            const uploadTime = document.createElement('span');
            const currentTime = new Date();
            uploadTime.textContent = ` - ${currentTime.toLocaleString()}`;

            listItem.appendChild(fileName);
            listItem.appendChild(uploadTime);

            fileListElement.appendChild(listItem);
        });
    }
}
</script>

    <script src="{{ asset('js/selected-nav-label.js') }}" defer></script>
  </body>
</html>
