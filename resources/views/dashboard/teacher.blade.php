@extends('app')
@section('title', 'Teacher Dashboard')

@section('links')

@endsection
@section('page-content')

    <div class="top">
        Welcome, {{ $user->firstname }}

        <p class="top-message">
            Greetings from the BCP Registrar System! You can now access this system as a teacher
        </p>
    </div>
@endsection

@section('scripts')

@endsection
