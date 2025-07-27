<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/6cbb66e0e0.js" crossorigin="anonymous"></script>
    <link rel="icon" href="../../icons/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../../icons/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/sidebar.css">
    <link rel="stylesheet" href="../../css/general.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/table.css">
    <link rel="stylesheet" href="../../css/overlay.css">

    <title> Student Profile </title>
  </head>

  <body>
    @include('../partials/registrar-header')
    @include('../partials/registrar-sidebar')

    <main class="student-profile">
      <div class="tabs">
        <!-- Student Profile Tab -->
        <input type="radio" name="tabs" id="tab1" checked>
        <label for="tab1"> Student Profile </label>

        <!-- Enrollment Status Tab -->
        <input type="radio" name="tabs" id="tab2">
        <label for="tab2"> Enrollment Status </label>

        <!-- Academic Records Tab -->
        <input type="radio" name="tabs" id="tab3">
        <label for="tab3"> Academic Records </label>

        <!-- COR Tab -->
        <input type="radio" name="tabs" id="tab4">
        <label for="tab4"> COR </label>

        <!-- Requests Tab -->
        <input type="radio" name="tabs" id="tab5">
        <label for="tab5"> Requests </label>

        <!-- Document Deficiencies Tab -->
        <input type="radio" name="tabs" id="tab6">
        <label for="tab6"> Deficiencies </label>

        <!-- Account System -->
        <input type="radio" name="tabs" id="tab7">
        <label for="tab7"> System Account </label>

        <!-- Student Profile Content -->
        <div class="tab-content" id="tab1-content">
          <div class="tab-content-container">
            <div class="content-title">
              Basic Information
            </div>

            <div class="student-info">
                <div class="info-group">
                    <div class="label"> Full Name: </div>
                    <div class="data"> {{ $student->firstname }} </div>
                </div>

              <div class="info-group">
                <div class="label"> Gender&#58; </div>
                <div class="data"> {{ $info->gender }} </div>
              </div>

              <div class="info-group">
                <div class="label"> Civil Status&#58; </div>
                <div class="data"> {{ $info->civil_status }} </div>
              </div>

              <div class="info-group">
                <div class="label"> Religion&#58; </div>
                <div class="data"> {{ $info->religion }} </div>
              </div>

              <div class="info-group">
                <div class="label"> Date of Birth&#58; </div>
                <div class="data"> {{ date('F d, Y', strtotime($info->dob)) }}</div>
              </div>

              {{-- @php
              $dob = \Carbon\Carbon::parse($student->dob);
              $age = $dob->diffInYears(\Carbon\Carbon::now());
              @endphp --}}

              <div class="info-group">
                <div class="label"> Age&#58; </div>
                <div class="data"> {{ $info->age }} years old</div>
              </div>

              <div class="info-group">
                <div class="label"> Nationality&#58; </div>
                <div class="data"> {{ $info->nationality }} </div>
              </div>
            </div>

            <div class="content-title">
              Contact Information
            </div>

            <div class="student-info">
              <div class="info-group">
                <div class="label"> Home Address&#58; </div>
                <div class="data"> {{ $info->address }} </div>
              </div>

              <div class="info-group">
                <div class="label"> Contact Number&#58; </div>
                <div class="data"> {{ $info->contact_no }} </div>
              </div>

              <div class="info-group">
                <div class="label"> Email Address&#58; </div>
                <div class="data"> {{ $info->email }} </div>
              </div>
            </div>

            <div class="content-title">
              Parent&#47;Guardian's Information
            </div>

            <div class="student-info">
              <div class="info-group">
                <div class="label"> Father&#58; </div>
                <div class="data"> {{ $parentGuardian->father_name }} </div>
              </div>

              <div class="info-group">
                <div class="label"> Mother&#58; </div>
                <div class="data"> {{ $parentGuardian->mother_name }} </div>
              </div>

              <div class="info-group">
                <div class="label"> Guardian&#58; </div>
                <div class="data"> {{ $parentGuardian->guardian_name }} </div>
              </div>

              <div class="info-group">
                <div class="label"> Guardian&#39;s Occupation&#58; </div>
                <div class="data"> {{ $parentGuardian->guardian_job }} </div>
              </div>

              <div class="info-group">
                <div class="label"> Guardian&#39;s Contact Number&#58; </div>
                <div class="data"> {{ $parentGuardian->guardian_contact_no }} </div>
              </div>

              <div class="info-group">
                <div class="label"> Guardian&#39;s Email Address&#58; </div>
                <div class="data"> {{ $parentGuardian->guardian_email }} </div>
              </div>

              <div class="info-group">
                <div class="label"> Guardian&#39;s Home Address&#58; </div>
                <div class="data"> {{ $parentGuardian->guardian_address }} </div>
              </div>
            </div>

            <div class="content-title">
              Educational Background
            </div>

            <div class="student-info">
              <div class="info-group">
                <div class="label"> Primary: </div>
                <div class="data"> {{ $educationalBg->primary_school }} </div>
              </div>

              <div class="info-group">
                <div class="label"> Year Graduated&#58; </div>
                <div class="data"> {{ $educationalBg->primary_year_graduated }} </div>
              </div>

              <div class="info-group">
                <div class="label"> Secondary&#58; </div>
                <div class="data"> {{ $educationalBg->secondary_school }} </div>
              </div>

              <div class="info-group">
                <div class="label"> Year Graduated&#58; </div>
                <div class="data"> {{ $educationalBg->secondary_year_graduated }} </div>
              </div>

              <div class="info-group">
                <div class="label"> Last School Attended&#58; </div>
                <div class="data"> {{ $educationalBg->last_school_attended }} </div>
              </div>

              <div class="info-group">
                <div class="label"> Year Graduated&#58; </div>
                <div class="data"> {{ $educationalBg->last_school_year_graduated }} </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Enrollment Status Content -->
        <div class="tab-content" id="tab2-content">
          <div class="tab-content-container">
            <div class="content-title">
              Current Enrollment
            </div>

            <div class="student-info">
              <div class="info-group">
                <div class="label"> Full Name&#58; </div>
                <div class="data">
                  Name of the Student
                </div>
              </div>

              <div class="info-group">
                <div class="label"> Student Number&#58; </div>
                <div class="data">
                  {{ $enrollmentStatus->student_no }}
                </div>
              </div>

              <div class="info-group">
                <div class="label"> Registration Date&#58; </div>
                <div class="data"> {{ date('F d, Y', strtotime($enrollmentStatus->registration_date)) }} </div>
              </div>

              <div class="info-group">
                <div class="label"> Academic Year&#58; </div>
                <div class="data"> {{ $academicYear->academic_year }} </div>
              </div>

              <div class="info-group">
                <div class="label"> Term&#58; </div>
                <div class="data"> {{ $academicTerm->academic_term }} </div>
              </div>

              <div class="info-group">
                <div class="label"> Year-Level&#58; </div>
                <div class="data"> {{ $yearLevel->year_levels }}</div>
              </div>

              <div class="info-group">
                <div class="label"> College&#58; </div>
                <div class="data"> {{ $course->college }} </div>
              </div>

              <div class="info-group">
                <div class="label"> Program&#58; </div>
                <div class="data"> {{ $course->program }} </div>
              </div>

              <div class="info-group">
                <div class="label">Major: </div>
                @if($course->major !== null)
                    <div class="data">{{ $course->major }}</div>
                @else
                    <div class="data">N&#47;A</div>
                @endif
              </div>

              <div class="info-group">
                <div class="label"> Section&#58; </div>
                <div class="data"> Bulacan {{ $section->section_name }} </div>
              </div>

              <div class="info-group">
                <div class="label"> Type&#58; </div>
                <div class="data"> {{ $studentType->type }} </div>
              </div>

              <div class="info-group">
                <div class="label"> Status&#58; </div>
                <div class="data"> {{ $status->status }} </div>
              </div>

              <div class="info-group">
                <div class="label">Back Subjects: </div>
                @if(count($backSubjects) > 0)
                    <div class="data">{{ implode('&#44; ', $backSubjects) }}</div>
                @else
                    <div class="data">none</div>
                @endif
              </div>


              <div class="info-group">
                <div class="label"> Adviser&#58; </div>
                <div class="data"> {{ $professor->full_name }} </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Academic Records Content -->
        <div class="tab-content" id="tab3-content">

          <div class="content-title">
            Student Grades
          </div>

            <a href="{{ route('printTor', ['studentNum'=>$student->studentNum]) }}" target="_blank">
              <button class="print-btn tor">
                Print TOR <i class="fa-solid fa-print"></i>
              </button>
            </a>

          <div class="tab-content-container">
          <div class="student-info">
              <div class="info-group">
                <div class="label"> Full Name&#58; </div>
                <div class="data"> Name of the Student </div>
              </div>

              <div class="info-group">
                <div class="label"> Student Number&#58; </div>
                <div class="data"> Student Number of the Student </div>
              </div>

              <div class="info-group">
                <div class="label"> Academic Year&#58; </div>
                <div class="data"> {{ $academicYear->academic_year }} </div>
              </div>

              <div class="info-group">
                <div class="label"> Year-Level&#58; </div>
                <div class="data"> {{ $yearLevel->year_levels }} </div>
              </div>

              <div class="info-group">
                <div class="label"> Term&#58; </div>
                <div class="data"> {{ $academicTerm->academic_term }} </div>
              </div>

              <div class="info-group">
                <div class="label"> Program&#58; </div>
                <div class="data"> {{ $course->program }} </div>
              </div>

              <div class="info-group">
                <div class="label"> Section&#58; </div>
                <div class="data"> Bulacan {{ $section->section_name }} </div>
              </div>

              <div class="info-group">
                <div class="label"> Type&#58; </div>
                <div class="data"> {{ $studentType->type }} </div>
              </div>

              <div class="info-group">
                <div class="label"> Status&#58; </div>
                <div class="data"> {{ $status->status }} </div>
              </div>

              <div class="info-group">
                <div class="label">Back Subjects: </div>
                @if(count($backSubjects) > 0)
                    <div class="data">{{ implode('&#44; ', $backSubjects) }}</div>
                @else
                    <div class="data">none</div>
                @endif
              </div>

              <div class="info-group">
                <div class="label"> Adviser&#58; </div>
                <div class="data"> {{ $professor->full_name }} </div>
              </div>
            </div>
          </div>

          <div class="grades">
            @php
              $year = 0;
            @endphp
            @foreach($subjectForYearLevel as $studSubj)
              @php
                $year = $studSubj->yearlevel_id;
              @endphp
            @endforeach
              <a href="{{ route('printsSheet', ['studentNum' => $student->studentNum, 'year' => $year]) }}" target="_blank">
                <button class="print-btn">
                  Print <i class="fa-solid fa-print"></i>
                </button>
              </a>

            <table id="gradeTable">
              <thead>
                <tr>
                  <th scope="col"> Subject Code </th>
                  <th scope="col"> Descriptive Title </th>
                  <th scope="col"> Professor </th>
                  <th scope="col"> Prelim </th>
                  <th scope="col"> Midterm </th>
                  <th scope="col"> Final </th>
                  <th scope="col"> Remarks </th>
                  <th scope="col"> Action </th>
                </tr>
              </thead>
              <tbody>
                @php
                    $totalGradePoints = 0;
                    $totalCreditUnits = 0;
                @endphp
                @foreach ($cGrades as $grade)
                  @if($grade->subjects->academicterm_id === 2)
                    <tr>
                      <td data-label="Subject Code">{{ $grade->subjects->subject_code }} </td>
                      <td data-label="Descriptive Title"> {{ $grade->subjects->descriptive_title }}</td>
                      <td data-label="Professor">{{ $grade->subjects->professors->full_name }}</td>
                      <td data-label="Prelim" contenteditable="false">{{ $grade->prelim_grade }}</td>
                      <td data-label="Midterm" contenteditable="false">{{ $grade->midterm_grade }}</td>
                      <td data-label="Final" contenteditable="false">{{ $grade->final_grade }}</td>
                      <td data-label="Remarks">  </td>
                      <td data-label="Action">
                        <button class="edit-btn">
                          <i class="fa-solid fa-pencil"></i>
                        </button>
                        <form action="{{ route('update-grade', ['id' => $grade->id]) }}" method="POST" class="hidden-form">
                          @csrf
                          <input type="hidden" name="prelim_grade" value="">
                          <input type="hidden" name="midterm_grade" value="">
                          <input type="hidden" name="final_grade" value="">
                          <button class="save-btn" style="display: none; border-radius: 5px; padding: 7px 15px; cursor: pointer; font-size: 8px;">
                              <i class="fa-solid fa-check"></i>
                          </button>
                        </form>
                      </td>
                    </tr>
                    @php
                        $gradePoints = $grade->final_grade * $grade->subjects->units;
                        $totalGradePoints += $gradePoints;
                        $totalCreditUnits += $grade->subjects->units;
                    @endphp
                  @endif
                @endforeach
              </tbody>
              <tfoot>
                @php
                    $gwa = $totalCreditUnits > 0 ? $totalGradePoints / $totalCreditUnits : 0;
                @endphp
                <tr class="gwa">
                  <td colspan="1"> GWA </td>
                  <td colspan="4"> &nbsp; </td>
                  <td>{{ number_format($gwa, 2) }}</td>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- CHECK -->
          @if($year !== 1 )
          <div class="student-info">
            <div class="info-group">
              <div class="label"> Academic Year&#58; </div>
              <div class="data"> {{ $yearThird->academic_year }} </div>
            </div>

            <div class="info-group">
              <div class="label"> Year-Level&#58; </div>
              <div class="data"> {{ $thirdYear->year_levels }} </div>
            </div>

            <div class="info-group">
              <div class="label"> Term&#58; </div>
              <div class="data"> {{ $termThird->academic_term }}  </div>
            </div>

            <div class="info-group">
              <div class="label"> Program&#58; </div>
              <div class="data"> {{ $course->program }}  </div>
            </div>

            <div class="info-group">
              <div class="label"> Section&#58; </div>
              <div class="data"> Bulacan {{ $thirdSection->section_name }} </div>
            </div>

            <div class="info-group">
              <div class="label"> Type&#58; </div>
              <div class="data"> {{ $studentType->type }} </div>
            </div>

            <div class="info-group">
              <div class="label"> Status&#58; </div>
              <div class="data"> {{ $status->status }} </div>
            </div>

            <div class="info-group">
              <div class="label">Back Subjects: </div>
              @if(count($backSubjects) > 0)
                  <div class="data">{{ implode('&#44; ', $backSubjects) }}</div>
              @else
                  <div class="data">none</div>
              @endif
            </div>

            <div class="info-group">
              <div class="label"> Adviser&#58; </div>
              <div class="data"> {{ $adviser3rd->full_name }} </div>
            </div>
          </div>
          @php
            $minusYear = 0;
          @endphp
          @foreach($subjectForYearLevelMinusOne as $studSubj)
            @php
              $minusYear = $studSubj->yearlevel_id;
            @endphp
          @endforeach
          <div class="grades">
            <a href="{{ route('printsSheet', ['studentNum' => $student->studentNum, 'year' => $minusYear]) }}" target="_blank">
              <button class="print-btn">
                Print <i class="fa-solid fa-print"></i>
              </button>
            </a>

            <table id="gradeTable">
              <thead>
                <tr>
                  <th scope="col"> Subject Code </th>
                  <th scope="col"> Descriptive Title </th>
                  <th scope="col"> Professor </th>
                  <th scope="col"> Prelim </th>
                  <th scope="col"> Midterm </th>
                  <th scope="col"> Final </th>
                  <th scope="col"> Remarks </th>
                  <th scope="col"> Action </th>
                </tr>
              </thead>
              <tbody>
                @php
                    $totalGradePoints = 0;
                    $totalCreditUnits = 0;
                @endphp
                @foreach ($cGrades2 as $grade)
                  @if($grade->subjects->academicterm_id === 1)
                    <tr>
                      <td data-label="Subject Code">{{ $grade->subjects->subject_code }} </td>
                      <td data-label="Descriptive Title"> {{ $grade->subjects->descriptive_title }}</td>
                      <td data-label="Professor">{{ $grade->subjects->professors->full_name }}</td>
                      <td data-label="Prelim" contenteditable="false">{{ $grade->prelim_grade }}</td>
                      <td data-label="Midterm" contenteditable="false">{{ $grade->midterm_grade }}</td>
                      <td data-label="Final" contenteditable="false">{{ $grade->final_grade }}</td>
                      <td data-label="Remarks">  </td>
                      <td data-label="Action">
                        <button class="edit-btn">
                          <i class="fa-solid fa-pencil"></i>
                        </button>
                        <form action="{{ route('update-grade', ['id' => $grade->id]) }}" method="POST" class="hidden-form">
                          @csrf
                          <input type="hidden" name="prelim_grade" value="">
                          <input type="hidden" name="midterm_grade" value="">
                          <input type="hidden" name="final_grade" value="">
                          <button class="save-btn" style="display: none; border-radius: 5px; padding: 7px 15px; cursor: pointer; font-size: 8px;">
                              <i class="fa-solid fa-check"></i>
                          </button>
                        </form>
                      </td>
                    </tr>
                    @php
                        $gradePoints = $grade->final_grade * $grade->subjects->units;
                        $totalGradePoints += $gradePoints;
                        $totalCreditUnits += $grade->subjects->units;
                    @endphp
                  @endif
                @endforeach
              </tbody>
              <tfoot>
                @php
                    $gwa = $totalCreditUnits > 0 ? $totalGradePoints / $totalCreditUnits : 0;
                @endphp
                <tr class="gwa">
                  <td colspan="1"> GWA </td>
                  <td colspan="4"> &nbsp; </td>
                  <td>{{ number_format($gwa, 2) }}</td>
                </tr>
              </tfoot>
            </table>
          </div>
          @endif
          <!-- CHECK -->
        </div>

        <!-- COR Content !-->
        <div class="tab-content" id="tab4-content">
          <div class="tab-content-container">
            <div class="content-title">
              Certificate of Registration
            </div>

            <a href="{{ route('printCor', ['studentNum'=>$student->studentNum]) }}" target="_blank">
              <button class="print-btn">
                Print <i class="fa-solid fa-print"></i>
              </button>
            </a>

            <table>
              <thead>
                <tr>
                  <th scope="col"> Code </th>
                  <th scope="col"> Descriptive Title </th>
                  <th scope="col"> Units </th>
                  <th scope="col"> Section </th>
                  <th scope="col"> Days </th>
                  <th scope="col"> Time </th>
                  <th scope="col"> Room </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($timetable as $item)
                <tr>
                    <td data-label="Code"> {{ $item->subjects->subject_code }} </td>
                    <td data-label="Subject Title"> {{ $item->subjects->descriptive_title }} </td>
                    <td data-label="Units"> {{ $item->subjects->units }} </td>
                    <td data-label="Section"> {{ $item->sections->section_name }} </td>
                    <td data-label="Days"> {{ $item->day_of_week }} </td>
                    <td data-label="Time">
                        @if($item->time_start && $item->time_end)
                            {{ \Carbon\Carbon::createFromTimestamp(strtotime($item->time_start))->format('H:i') }}
                            -
                            {{ \Carbon\Carbon::createFromTimestamp(strtotime($item->time_end))->format('H:i') }}
                        @endif
                    </td>
                    <td data-label="Room"> {{ $item->room }} </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <!-- Requests Content !-->
        <div class="tab-content" id="tab5-content">
          <div class="tab-content-container">

            <div class="content-title" id="student-requests">
              Request&#40;s&#41;
            </div>

            <div class="sub-title">
              Pending
            </div>

            @foreach($matchedRequests as $request)
            @if($request->status === 'Pending' && $request->studentNum === $student->studentNum)
            <div class="students-requests-container">
                <div class="students-requests">
                  <p id="postedRequests">
                    {{ $request->user->firstname }} requested
                    <strong>
                      @if($request->document)
                          {{ $request->document->document_name }}
                      @else
                          No Document Available
                      @endif
                    </strong>
                  <br>
                    <em>{{ $request->created_at->format('m/d/Y h:i:s A') }}</em>
                  </p>
                  <!--<a href="route('paymentProof', ['id' => $request->id])" target="_blank">Proof of Payment</a>-->
                  <div class="request-btns">
                    <button class="done-btn" id="" onclick="toggleStartProcessOverlay()">
                      Start Processing
                    </button>

                    <div id="startprocess-overlay" class="overlay">
                      <div class="overlay-content">
                        <button class="close-btn" onclick="toggleStartProcessOverlay()">&times;</button>

                        <div class="form">
                          <div class="content-title">
                            Send a Message
                          </div>

                          <form action="{{ route('updatePending', ['id' => $request->id]) }}" class="form" method="POST">
                            @csrf
                          <div class="pair">
                            <div class="settings-label">
                              Message
                            </div>

                            <textarea name="message">We're currently preparing your document. Please come to the registrar's office on [DAY] between [START TIME] and [END TIME] to pick up your document.</textarea>
                          </div>
                            <button class="send-btn" name="submit" type="submit">
                              Send
                            </button>
                          </form>
                        </div>
                      </div>
                    </div>

                    <button class="view" id="" onclick="toggleOverlay({{ $request->id }})">
                      View Details
                    </button>
                  </div>
                </div>
            </div>
            @endif
            @endforeach

            <div class="sub-title">
              In-Process
            </div>

            @foreach($matchedRequests as $request)
            @if($request->status === 'In-Process' && $request->studentNum === $student->studentNum)
            <div class="students-requests">
                  <p id="postedRequests">
                    Processing
                    <strong>
                      @if($request->document)
                          {{ $request->document->document_name }}
                      @else
                          No Document Available
                      @endif
                    </strong>
                  <br>
                    <em>{{ $request->updated_at->format('m/d/Y h:i:s A') }}</em>
                  </p>
                  <div class="request-btns">
                    <form action="{{ route('updateProcess', ['id' => $request->id]) }}" class="form" method="POST">
                      @csrf
                      <button class="send-btn" name="submit" type="submit">
                        Done
                      </button>
                    </form>

                    <button class="view" id="" onclick="toggleOverlay({{ $request->id }})">
                      View Details
                    </button>
                  </div>
            </div>
            @endif
            @endforeach

            <div class="sub-title">
              Finished
            </div>

            @foreach($matchedRequests as $request)
            @if($request->status === 'Finished' && $request->studentNum === $student->studentNum)
            <div class="students-requests">
                <p id="postedRequests">
                  <strong>
                    @if($request->document)
                        {{ $request->document->document_name }}
                    @else
                        No Document Available
                    @endif
                  </strong>
                <br>
                    <em>{{ $request->updated_at->format('m/d/Y h:i:s A') }}</em>
                </p>
                <button class="view" id="" onclick="toggleOverlay({{ $request->id }})">
                  View Details
                </button>
            </div>
            @endif
            @endforeach
          </div>
          @include('partials/reg-details-overlay')
      </div>

       <!--Document Deficiencies Content -->
      <div class="tab-content" id="tab6-content">
        <div class="tab-content-container">
          <div class="content-title">
            Document Deficiencies
          </div>

          <form action="{{ route('storeDef') }}" class="form" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="student_no" value="{{ $student->studentNum }}" hidden>
            <div class="docudef-container">
              <div class="input-grp">
                <div class="settings-label">
                  Document
                </div>

                <input type="text" name="document">
              </div>

              <div class="input-grp">
                <div class="settings-label">
                  Deadline
                </div>

                <input type="date" name="deadline">
              </div>

              <button class="done-btn" type="submit">
                Submit
              </button>
            </div>
          </form>

          <div class="content-title">
            List
          </div>
          @if(Session::has('success'))
              <div class="alert alert-success" role="alert">
                  {{ Session::get('success') }}
              </div>
          @endif
          @if($deficiencies->isNotEmpty())
            @foreach($deficiencies as $deficiency)
            <div class="list-container">
              <div class="left-list">
                <div class="list">
                  <div class="list-label">
                    Document
                  </div>

                  <div class="list-data">
                    {{ $deficiency->document }}
                  </div>
                </div>

                <div class="list">
                  <div class="list-label">
                    Deadline
                  </div>

                  <div class="list-data">
                    {{ date('d/m/Y', strtotime($deficiency->deadline)) }}
                  </div>
                </div>
              </div>

              <div class="right-list">
                <form method="POST" action="{{ route('destroyDef', $deficiency->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="trash-btn">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
              </div>
            </div>
            @endforeach
          @else
              <p>No deficiencies found for this student.</p>
          @endif

        </div>
      </div>

       <!--ACCOUNT -->
      <div class="tab-content" id="tab7-content">
        <div class="tab-content-container">
          <div class="content-title">
            Account Credentials
          </div>
        </div>
      </div>
    </main>
    <script>
      const basePaymentProofUrl = "{{ route('paymentProof', ['id' => ':id']) }}";
    </script>

    <script src="../../js/selected-nav-label.js" ></script>
    <script src="../../js/overlay.js" defer></script>
    <script src="../../js/startprocess-overlay.js" defer></script>
    <script src="../../js/edit.js" defer></script>
  </body>
</html>
