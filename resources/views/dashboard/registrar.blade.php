@extends('app')
@section('title', 'Registrar Dashboard')

@section('links')

@endsection
@section('page-content')

@php
    $user = Auth::user();
@endphp
<div class="top">
    Welcome, {{ $user->firstname }}

    <p class="top-message">
      Greetings from the BCP Registrar System! You may now access the student records
    </p>
</div>


<div class="row mb-3">
    <div class="col-lg-4 mb-2">
        <div class="card h-100" style="background-image: linear-gradient(135deg, #5490f0, #99B8F6); border-radius: 1rem;">
            <div class="card-body shadow-sm">
                <div class="d-flex align-items-center justify-content-center text-center flex-wrap gap-2">
                    <div class="col-auto h-100">
                        <img width="50" height="50" src="https://img.icons8.com/ios-filled/100/ffffff/conference-call.png"/>
                    </div>
                    <div class="col mt-0">
                        <h3 class="mb-0 text-white" style="font-size:55px;font-family: 'Kanit', sans-serif;font-weight:bold">
                            <span>
                                {{ $totalStudentCount }}
                            </span>
                        </h3>
                        <h4 class="mb-0 text-white" style="font-family: 'Kanit', sans-serif;font-weight:bold">Students</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 mb-2">
        <div class="card h-100" style="background-image: linear-gradient(135deg, #5490f0, #99B8F6); border-radius: 1rem;">
            <div class="card-body shadow-sm">
                <div class="d-flex align-items-center justify-content-center text-center flex-wrap gap-2">
                    <div class="col-auto h-100">
                        <img width="50" height="50" src="https://img.icons8.com/ios-filled/100/ffffff/open-book.png" alt="open-book"/>
                    </div>
                    <div class="col mt-0">
                        <h3 class="mb-0 text-white" style="font-size:55px;font-family: 'Kanit', sans-serif;font-weight:bold">
                            <span>{{ $totalCourseCount }}</span>
                        </h3>
                        <h4 class="mb-0 text-white" style="font-family: 'Kanit', sans-serif;font-weight:bold">Courses</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 mb-2">
        <div class="card h-100" style="background-image: linear-gradient(135deg, #5490f0, #99B8F6); border-radius: 1rem;">
            <div class="card-body shadow-sm">
                <div class="d-flex align-items-center justify-content-center text-center flex-wrap gap-2">
                    <div class="col-auto h-100">
                        <img width="50" height="50" src="https://img.icons8.com/ios-filled/100/ffffff/appointment-reminders--v1.png"/>
                    </div>
                    <div class="col mt-0">
                        <h3 class="mb-0 text-white" style="font-size:55px;font-family: 'Kanit', sans-serif;font-weight:bold">
                            <span>{{ $totalRequestsCount }}</span>
                        </h3>
                        <h4 class="mb-0 text-white" style="font-family: 'Kanit', sans-serif;font-weight:bold">Requests</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="requests-container">
    <div class="table-caption">
        Requests
    </div>

    <table class="requests">
        <thead>
            <tr>
                <th scope="col"> Request Number </th>
                <th scope="col"> Name </th>
                <th scope="col"> Request </th>
                <th scope="col"> Date </th>
                <th scope="col"> Action </th>
            </tr>
        </thead>
        <tbody>
          @foreach($requests as $request)
          @if($request->status != 'Finished')
              <tr>
                  <td data-label="Request Number">{{ $request->id }}</td>
                  <td data-label="Name">
                      {{ $request->firstname }} {{ $request->middlename }} {{ $request->lastname }}
                  </td>
                  <!-- Include other columns from the "requests" table as needed -->
                  <td data-label="Request">
                      @if($request->document)
                          {{ $request->document->document_name }}
                      @else
                          No Document Available
                      @endif
                  </td>
                  <td data-label="Date">{{ $request->created_at->format('F d, Y') }}</td>
                  <td data-label="Action">
                      <a href="{{ route('students.view-profile.requests', ['id' => $request->studentNum]) }}" data-page-title="Student Information" onclick="handleClick(this)">
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
