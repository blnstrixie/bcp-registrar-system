@extends('app')

@section('title')
Analytics
@endsection

@section('page-content')

<div class="top">
    Welcome, {{ Auth::user()->firstname }}

    <p class="top-message">
        Greetings from the BCP Registrar System! You can now access this system as a student
    </p>
</div>

<div class="cards-container">
    <div class="card">
        <div class="card-stats">
            <p class="course-label">
                {{ $course->program }}
            </p>

            <div class="course-stats">
                <i class="fa-solid fa-book-open-reader"></i>

                <p class="card-label">
                    Course
                </p>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-stats">
            <p class="course-label">
                Bulacan <br> {{ $section->section_name }}
            </p>

            <div class="course-stats">
                <i class="fa-solid fa-school"></i>

                <p class="card-label">
                    Section
                </p>
            </div>
        </div>
    </div>

    <div class="card">
        <i class="fa-solid fa-bell"></i>

        <div class="card-stats">
            <p class="number">
                {{ $totalNotifications }}
            </p>
            <p class="card-label">
                Notifications
            </p>
        </div>
    </div>
</div>
</div>

<div class="requests-container">
    <div class="table-caption">
        Active Requests
    </div>

    <table class="requests">
        <thead>
            <tr>
                <th scope="col"> Request Number </th>
                <th scope="col"> Request </th>
                <th scope="col"> Date </th>
                <th scope="col"> Message </th>
                <th scope="col"> Action </th>
            </tr>
        </thead>
        <tbody>
            @foreach($matchedRequests as $request)
            @if($request->notification_status === 1)
            <tr>
                <td data-label="Request Number"> {{ $request->notification_id}} </td>
                <td data-label="Request"> {{ $request->document_name }} </td>
                <td data-label="Date"> {{ date('F d, Y', strtotime($request->updated)) }} </td>
                <td data-label="Status">
                    @if($request->status === 'In-Process' || $request->status === 'Pending' )
                    {{ $request->registrar_message }}
                    @else
                    Done
                    @endif
                </td>
                <td data-label="Action">
                    <a href="{{ route('student/documents-hub') }}" data-page-title="Documents Hub" onclick="handleClick(this)">
                        <button class="view-btn">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                    </a>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')

@endsection

