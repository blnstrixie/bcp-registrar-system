@extends('app')
@section('title', 'Admin Dashboard')

@section('links')

@endsection
@section('page-content')

@php
    $user = Auth::user();
@endphp
<div class="top">
    Welcome, {{ $user->firstname }}

    <p class="top-message">
      Greetings from the BCP Registrar System! You may now manage the system users
    </p>
</div>

@php
    $users = new \App\Models\User();

    $users_count = $users->where('role','!=','admin')->get()->count();
    $registrars_count = $users->where('role','registrar')->get()->count();
    $teachers_count = $users->where('role','Teacher')->get()->count();
    $students_count = $users->where('role','student')->get()->count();

@endphp
<div class="row mb-3">
    <div class="col-lg-6 mb-2">
        <div class="card h-100" style="background-image: linear-gradient(135deg, #5490f0, #99B8F6); border-radius: 1rem;">
            <div class="card-body shadow-sm">
                <div class="d-flex align-items-center justify-content-center text-center flex-wrap gap-2">
                    <div class="col-auto h-100">
                        <img width="50" height="50" src="https://img.icons8.com/ios-filled/100/ffffff/conference-call.png"/>
                    </div>
                    <div class="col mt-0">
                        <h3 class="mb-0 text-white" style="font-size:55px;font-family: 'Kanit', sans-serif;font-weight:bold">
                            <span>{{ $users_count }}</span>
                        </h3>
                        <h4 class="mb-0 text-white" style="font-family: 'Kanit', sans-serif;font-weight:bold">Total Users</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-2">
        <div class="card h-100" style="background-image: linear-gradient(135deg, #5490f0, #99B8F6); border-radius: 1rem;">
            <div class="card-body shadow-sm">
                <div class="d-flex align-items-center justify-content-center text-center flex-wrap gap-2">
                    <div class="col-auto h-100">
                        <img width="50" height="50" src="https://img.icons8.com/fluency-systems-regular//100/ffffff/clerk.png"/>
                    </div>
                    <div class="col mt-0">
                        <h3 class="mb-0 text-white" style="font-size:55px;font-family: 'Kanit', sans-serif;font-weight:bold">
                            <span>{{ $registrars_count }}</span>
                        </h3>
                        <h4 class="mb-0 text-white" style="font-family: 'Kanit', sans-serif;font-weight:bold">Registrars</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-2">
        <div class="card h-100" style="background-image: linear-gradient(135deg, #5490f0, #99B8F6); border-radius: 1rem;">
            <div class="card-body shadow-sm">
                <div class="d-flex align-items-center justify-content-center text-center flex-wrap gap-2">
                    <div class="col-auto h-100">
                        <img width="50" height="50" src="https://img.icons8.com/external-basicons-line-edtgraphics/100/ffffff/external-Teacher-teachers-basicons-line-edtgraphics-16.png"/>
                    </div>
                    <div class="col mt-0">
                        <h3 class="mb-0 text-white" style="font-size:55px;font-family: 'Kanit', sans-serif;font-weight:bold">
                            <span>{{ $teachers_count }}</span>
                        </h3>
                        <h4 class="mb-0 text-white" style="font-family: 'Kanit', sans-serif;font-weight:bold">Teachers</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 mb-2">
        <div class="card h-100" style="background-image: linear-gradient(135deg, #5490f0, #99B8F6); border-radius: 1rem;">
            <div class="card-body shadow-sm">
                <div class="d-flex align-items-center justify-content-center text-center flex-wrap gap-2">
                    <div class="col-auto h-100">
                        <img width="50" height="50" src="https://img.icons8.com/windows/100/ffffff/raise-a-hand-to-answer.png"/>
                    </div>
                    <div class="col mt-0">
                        <h3 class="mb-0 text-white" style="font-size:55px;font-family: 'Kanit', sans-serif;font-weight:bold">
                            <span>{{ $students_count }}</span>
                        </h3>
                        <h4 class="mb-0 text-white" style="font-family: 'Kanit', sans-serif;font-weight:bold">Students</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection
