@extends('app')
@section('title')
    User Management
@endsection
@section('links')
@endsection

@section('page-content')
    <div class="d-flex justify-content-start mb-3">
        <a href="{{ route('user-management') }}" type="button" class="btn btn-secondary">Back to Users List</a>
    </div>
    <div class="content-title">
        View User Account
    </div>

    <div class="card shadow-lg">
        <div class="card-body">
            <form>
                @if($user->role == 'Student')
                    <div class="form-group">
                        <label>Student Number:</label>
                        <input type="text" class="form-control" readonly value="{{ $user->studentNum }}">
                    </div>
                @endif
                <div class="form-row mb-2">
                    <div class="form-group col-md-5">
                        <label>Last Name:</label>
                        <input type="text" class="form-control" placeholder="Last Name" readonly value="{{ ucwords($user->lastname) }}">
                    </div>
                    <div class="form-group col-md-5">
                        <label>First Name:</label>
                        <input type="text" class="form-control" placeholder="First Name" readonly value="{{ ucwords($user->firstname) }}">
                    </div>
                    <div class="form-group col-md-2">
                        <label>Middle Name:</label>
                        <input type="text" class="form-control" placeholder="" readonly value="{{ ucwords($user->middlename) }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>Email Address:</label>
                    <input type="email" class="form-control" readonly value="{{ $user->emailAdd }}">
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <input type="text" class="form-control" readonly value="{{ $user->role }}">
                </div>
                <div class="form-group">
                    <label>Complete Address:</label>
                    <input type="text" class="form-control" readonly value="{{ $user->complete_address }}">
                </div>
                <div class="form-group" style="text-align: right">
                    <label>Account created: <span>{{ date('F d, Y h:i a', strtotime($user->created_at)) }}</span></label>
                    {{-- <input type="text" class="form-control" readonly value="{{ $user->complete_address }}"> --}}
                </div>
            </form>
        </div>
    </div>
@endsection


@section('scripts')
@endsection
