@extends('app')
@section('title', 'Account Settings')
@section('links')

    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />

    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
@endsection

@section('page-content')

    <div class="tabs">
        <!-- Profile Tab -->
        <input type="radio" name="tabs" id="tab1" checked>
        <label for="tab1"> Profile </label>

        <!-- Account Tab -->
        <input type="radio" name="tabs" id="tab2">
        <label for="tab2"> Account </label>

        <!-- Profile Tab Content -->
        <div class="tab-content" id="tab1-content">
            {{-- <form action="{{ route('account.update-profile') }}" class="form" method="POST" enctype="multipart/form-data" id="profileForm"> --}}
            <form action="" class="form" id="profileForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <div class="tab-content-container">
                    <div class="content-title">
                        Edit Profile <i span class="fa-solid fa-pen-to-square"></i>
                    </div>

                    <div class="profile-upload">
                        @php
                            $source = asset('images/anya.jpg');
                            if (Auth::user()->avatar) {
                                $avatar = Auth::user()->avatar;
                                $source = asset($avatar);
                            }
                        @endphp
                        <img class="profile-picture" id="profilePicture1" src="{{ $source }}">

                        <div class="right-profile">
                            <div class="upload-text">
                                Upload Profile Picture
                            </div>

                            <div class="upload-support">
                                We support JPGs and PNGs under 10MB
                            </div>
                            <input type="file" name="profile_pic" id="profile_pic" />
                            <button type="button" class="upload-btn w-100" id="upload-profile-btn">
                                <i class="fa-solid fa-cloud-arrow-up"></i> <span id="text">Upload</span>
                            </button>
                        </div>
                    </div>

                    {{-- <!-- DATA -->
                        <div class="input-pair">
                            <div class="input-group">
                            <div class="settings-label"> First Name </div>
                            <input type="text" name="firstname" id="firstname" autocomplete="on" value="Catherine">
                            </div>

                            <div class="input-group">
                            <div class="settings-label"> Last Name </div>
                            <input type="text" name="lastname" id="lastname" autocomplete="on" value="Francisco">
                            </div>
                        </div>

                        <div class="input-pair">
                            <div class="input-group">
                            <div class="settings-label"> Middle Name </div>
                            <input type="text" name="middlename" id="middlename" autocomplete="on" value="">
                            </div>

                            <div class="input-group">
                            <div class="settings-label"> Suffix </div>
                            <input type="text" name="suffix" id="suffix-name" autocomplete="on" value="">
                            </div>
                        </div>
                    --}}
                </div>
            </form>
        </div>

        <script>
            const form = document.getElementById('profileForm');
            const inputs = form.querySelectorAll('input[type="text"]');
            // const fileInput = document.getElementById('fileInput1');
            const saveButton = document.getElementById('saveButton');

            function checkChanges() {
                let changed = false;
                inputs.forEach(input => {
                    if (input.value !== input.defaultValue) {
                        changed = true;
                    }
                });

                // if (fileInput.files.length > 0) {
                //     changed = true;
                // }

                saveButton.disabled = !changed;
            }

            inputs.forEach(input => {
                input.addEventListener('input', checkChanges);
            });

            // fileInput.addEventListener('change', checkChanges);
        </script>

        <!-- Account Tab Content -->
        <div class="tab-content" id="tab2-content">
            <div class="tab-content-container">
                <div class="content-title">
                    My Account
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow" style="border:solid 1px #cfcfcf">
                            <div class="card-body">
                                <form id="user-account-form" action="{{ route('account.update-account') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" id="">
                                    <h3 class="text-center"><strong>My Account</strong></h3>
                                    <div class="col-lg-12 mb-2">
                                        <label class="form-label mb-0"><strong>Username:</strong> </label>
                                        <input required id="username" name="username" type="text" class="form-control" placeholder="Enter your username" value="{{ Auth::user()->username }}">
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="form-label mb-0"><strong>Email:</strong> </label>
                                        <input required id="user_email" name="email" type="email" class="form-control" placeholder="Enter your email" value="{{ Auth::user()->emailAdd }}">
                                    </div>
                                    <div class="col-lg-12 mb-5">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label mb-0"><strong>Change Password:</strong> </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <input id="current_password" name="password" type="password" class="form-control" placeholder="Current Password" value="">
                                            </div>
                                            <div class="col-lg-6">
                                                <input id="new_password" name="new_password" type="password" class="form-control" placeholder="New Password" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-grid mt-3">
                                        <button class="save-btn" type="submit" > Save </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    {{-- FILEPOND JS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
    <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script>
        // Register the plugin
        FilePond.registerPlugin(FilePondPluginImagePreview);
        // Get a reference to the file input element
        const inputElement = document.querySelector('#profile_pic');

        // Create a FilePond instance
        const pond_profile = FilePond.create(inputElement, {
            imagePreviewMinHeight: '75',
            imagePreviewMaxHeight: '120',
        });
        pond_profile.on('addfile', (error, file) => {
            // PutIntoInput();
            console.log(file);
        });
        $('#upload-profile-btn').on('click', function() {

            alertify.set('notifier', 'position', 'top-center');

            var $form = $('profileForm');
            var frmData = new FormData($form[0]);

            var pic_count = 0;

            pondFiles = pond_profile.getFiles();
            for (var i = 0; i < pondFiles.length; i++) {
                frmData.append('profile_picture', pondFiles[i].file);
                pic_count = 1;
            }
            frmData.append('user_id', '{{ Auth::user()->id }}');

            if (pic_count < 1) {
                alertify.error('Please upload your picture.');
                return;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#upload-profile-btn').prop({
                'disabled': true
            })
            $('#upload-profile-btn #text').text('Uploading...')
            $.ajax({
                type: 'POST',
                url: '{{ route('account.update-profile') }}',
                processData: false,
                contentType: false,
                cache: false,
                data: frmData,
                success: function(data) {
                    console.log(data);
                    alertify.success('Upload Success.');
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                },
                error: function(e) {

                    $('#upload-profile-btn').prop({
                        'disabled': false
                    })

                    $('#upload-profile-btn #text').text('Upload')
                    alertify.error('Something went wrong.');
                }
            })
        })

    </script>

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

    <script>
        $(document).ready(function() {
            // Check if new_password has a value on page load
            checkNewPassword();

            // Attach an event listener to new_password input
            $('#new_password').on('input', function() {
                checkNewPassword();
            });

            function checkNewPassword() {
                // If new_password has a value, add required attribute to current_password
                if ($('#new_password').val() !== '') {
                    $('#current_password').prop('required', true);
                } else {
                    // If new_password is empty, remove required attribute from current_password
                    $('#current_password').prop('required', false);
                }
            }
        });
    </script>

    <script>
        $(document).ready(function () {

        })
        @if (Session::has('saved-account'))
            $('#tab2').prop('checked', true).trigger('change');
        @endif
    </script>
@endsection
