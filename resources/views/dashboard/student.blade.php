@extends('app')
@section('title', 'Student Dashboard')

@section('links')

@endsection
@section('page-content')

<div class="top">
    Welcome, {{ $user->firstname }}

    <p class="top-message">
      Greetings from the BCP Registrar System! You can now access this system as a student
    </p>
</div>


  <div class="row mb-4">
    <div class="col-12">
        <div class="d-flex flex-column flex-md-row justify-content-between gap-3">
            <!-- Course Card -->
            <div class="card flex-fill" style="background-image: linear-gradient(135deg, #5490f0, #99B8F6); border-radius: 1rem;">
                <div class="card-body p-4 d-flex align-items-center gap-3">
                    <img width="50" height="50" src="https://img.icons8.com/ios-filled/100/ffffff/open-book.png" alt="open-book"/>
                    <h5 class="text-white m-0" style="font-family: 'Kanit', sans-serif; font-weight: bold;">
                        {{ str_replace('Bachelor of Science in','BS ', $course->program) }}
                    </h5>
                </div>
            </div>

            <!-- Section Card -->
            <div class="card flex-fill" style="background-image: linear-gradient(135deg, #5490f0, #99B8F6); border-radius: 1rem;">
                <div class="card-body p-4 d-flex align-items-center gap-3">
                    <img width="70" height="70" src="https://img.icons8.com/glyph-neue/100/ffffff/classroom.png" alt="classroom"/>
                    <h5 class="text-white m-0" style="font-family: 'Kanit', sans-serif; font-weight: bold;">
                        {{ $section->section_name }}
                    </h5>
                </div>
            </div>
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
          <!-- <th scope="col"> Request Number </th> -->
          <th scope="col"> Request </th>
          <th scope="col"> Date </th>
          <th scope="col"> Message </th>
          <th scope="col"> Action </th>
        </tr>
      </thead>
      <tbody>
        @foreach($matchedRequests as $request)
          @if($request->status === 'Pending' || $request->status === 'In-Process')
          <tr>
            <!-- <td data-label="Request Number"> {{ $request->notification_id}} </td> -->
            <td data-label="Request"> {{ $request->document_name }} </td>
            <td data-label="Date"> {{ date('F d, Y', strtotime($request->created_at)) }} </td>
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
