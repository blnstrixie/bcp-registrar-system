<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Student;
use App\Models\Graduate;
use App\Models\Subjects;
use App\Models\YearLevels;
use App\Models\Sections;
use App\Models\EnrollmentStatus;
use App\Models\StudentType;
use App\Models\StudentStatus;
use App\Models\ParentGuardian;
use App\Models\EducationalBg;
use App\Models\Grades;
use App\Models\BackSubjects;
use App\Models\Professors;
use App\Models\Courses;
use App\Models\AcademicTerm;
use App\Models\AcademicYear;
use App\Models\Timetable;
use App\Models\Deficiencies;
use App\Models\Requests;
use App\Models\Notifications;
use App\Models\Documents;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;
use DataTables;
use Session;

class StudentController extends Controller
{
    public function index(){
        $user = Auth::user();
        $student = Student::where('student_no', $user->studentNum)->firstOrFail();
        $enrollmentStatus = EnrollmentStatus::where('student_no', $student->student_no)->first();
        $course = Courses::find($enrollmentStatus->course_id);
        $section = Sections::find($enrollmentStatus->section_id);

        $totalNotif = DB::table('notifications')
            ->join('requests', 'notifications.request_id', '=', 'requests.id')
            ->where('requests.studentNum', $user->studentNum)
            ->where('notifications.status', true)
            ->selectRaw('COUNT(DISTINCT notifications.request_id) as total')
            ->first();

        $totalNotifications = $totalNotif->total ?? 0;
    
        $matchedRequests = DB::table('requests')
            ->join('documents', 'requests.documentId', '=', 'documents.id')
            ->leftJoin('notifications', function ($join) {
                $join->on('requests.id', '=', 'notifications.request_id')
                    ->whereColumn('requests.id', '=', 'notifications.request_id');
            })
            ->select(
                'requests.*',
                'documents.*',
                'notifications.id as notification_id',
                'notifications.status as notification_status',
                'notifications.updated_at as updated'
            )
            ->whereIn('notifications.id', function ($query) {
                $query->select(DB::raw('MIN(id)'))
                    ->from('notifications')
                    ->groupBy('request_id');
            })
            ->get();

        return view('student/dashboard', compact('user', 'student', 'course', 'section', 'totalNotifications', 'matchedRequests'));
    }

    public function profile(){
        $user = Auth::user();
        $student = Student::where('student_no', $user->studentNum)->firstOrFail();
        $enrollmentStatus = EnrollmentStatus::where('student_no', $student->student_no)->first();

        $yearLevel = YearLevels::find($enrollmentStatus->yearlevel_id);
        $course = Courses::find($enrollmentStatus->course_id);
        $section = Sections::find($enrollmentStatus->section_id);
        $studentType = StudentType::find($enrollmentStatus->type_id);
        $status = StudentStatus::find($enrollmentStatus->status_id);
        $backSubject = BackSubjects::find($enrollmentStatus->backsubject_id);
        $professor = Professors::find($enrollmentStatus->prof_id);
        $cYear = $yearLevel->id;
        $timetable = Timetable::with('subjects', 'sections')
                        ->whereHas('subjects', function($query) use ($cYear) {
                            $query->where('yearlevel_id', $cYear);
                        })->get();

        $acadYear = AcademicYear::where('id', $yearLevel->id)->first();
        $year = AcademicYear::find($acadYear->id);
        $term = AcademicTerm::find($enrollmentStatus->term);

        $subject = null;

        $backSubjects = [];

        if ($backSubject && $backSubject->subject_id !== 0 && !empty($backSubject->subject_id)) {
            $backSubjectsData = BackSubjects::where('student_no', $student->studentNum)->get();

            foreach ($backSubjectsData as $backSubj) {
                $subject = Subjects::find($backSubj->subject_id);
                if ($subject) {
                    $backSubjects[] = $subject->descriptive_title;
                }
            }
        }
        return view('content.students.profile', compact('user','student','enrollmentStatus','yearLevel','course','section','studentType','status','backSubjects','professor','year','term','timetable'));
        // return view('student/profile', compact('user','student','enrollmentStatus','yearLevel','course','section','studentType','status','backSubjects','professor','year','term','timetable'));
    }

    public function documentsHub(){
        $user = Auth::user();
        $documents = Documents::all();
        $paymentmethods = PaymentMethod::all();
        $deficiencies = Deficiencies::where('student_no', $user->studentNum)->get();
        $matchedRequests = Requests::with('user', 'document', 'paymentmethod')->get();

        $student_requests = Requests::where('studentNum', Auth::user()->studentNum)->get();
        return view('content.students.doc-request', compact('user', 'matchedRequests', 'deficiencies', 'documents', 'paymentmethods','student_requests'));
        // return view('student/documents-hub', compact('user', 'matchedRequests', 'deficiencies', 'documents', 'paymentmethods'));
        return view('student/documents-hub', compact('user', 'matchedRequests', 'deficiencies', 'documents', 'paymentmethods'));
    }

    public function doc_get_message(Request $request) {
        try {
            $message = 'No message found.';

            $req_doc = Requests::where('id',$request->id)->first();
            if($req_doc) {
                $message = $req_doc->registrar_message;
            }
            return response()->json(['message' => $message]);
        }
        catch(\Throwable $th) {
            return response()->json(['message' => $th->getMessage()]);
        }
    }
    public function requests(Request $request){
        $input = $request->all();

        if ($request->hasFile('paymentProof')) {
            $qrcode = $request->file('paymentProof');
            if ($qrcode->isValid()) {
                $qrcode->move('images', $qrcode->getClientOriginalName());
                $input['paymentProof'] = 'images/' . $qrcode->getClientOriginalName();
            } else {
                return redirect('/documents-hub')->with('error', 'Invalid file uploaded.');
            }
        } else {
            $input['qrcode'] = null;
        }

        Requests::create($input);

        Session::flash('message', 'Request Document has been submitted.');
        Session::flash('saved-session-tab', '1');
        return back();
        return redirect('/documents-hub')->with('success', 'Your request is currently in a pending status.');
    }

    public function viewDetails($id){
        $request = Requests::with('user', 'document', 'paymentmethod')
                    ->where('id', $id)
                    ->firstOrFail();

        return response()->json([
            'id' => $request->id,
            'firstName' => $request->user->firstname ?? null,
            'middleName' => $request->user->middlename ?? null,
            'lastName' => $request->user->lastname ?? null,
            'document' => $request->document->document_name ?? null,
            'fee' => $request->document->fee ?? null,
            'paymentMethod' => $request->paymentmethod->payment_method ?? null,
            'paymentProof' => $request->paymentProof ?? null
        ]);
    }

    public function prof(Request $request, $id) {
        $userProf = User::find($id);

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            if ($avatar->isValid()) {
                $avatar->move('avatars', $avatar->getClientOriginalName());
                $userProf->avatar = 'avatars/' . $avatar->getClientOriginalName();
            } else {
                return redirect('/settings')->with('error', 'Invalid file uploaded.');
            }
        }

        $input = $request->except('avatar');
        $userProf->update($input);

        return redirect('/settings')->with('success', 'Updated Successfully.');
    }

    public function acc(Request $request, $id) {
        $userProf = User::find($id);

        $updatingUsernameEmail = $request->filled('username') || $request->filled('email');
        $currentPasswordProvided = $request->filled('current');

        if ($updatingUsernameEmail && $currentPasswordProvided) {
            $currentPassword = $request->input('current');
            if (!password_verify($currentPassword, $userProf->password)) {
                return redirect('/settings')->with('error', 'Current password is incorrect.');
            }
        }

        $userProf->emailAdd = $request->input('email', $userProf->emailAdd);
        $userProf->username = $request->input('username', $userProf->username);

        $updatingPassword = $request->filled('new-password') || $request->filled('confirm-password');

        if ($updatingPassword) {
            $newPassword = $request->input('new-password');
            $confirmPassword = $request->input('confirm-password');

            if ($newPassword !== $confirmPassword) {
                return redirect('/settings')->with('error', 'New password and confirm password do not match.');
            }

            $userProf->password = $newPassword;
        }

        if ($userProf->isDirty()) {
            $userProf->save();
            return redirect('/settings')->with('success', 'Updated Successfully.');
        }

        return redirect('/settings')->with('success', 'No changes detected.');
    }

    public function settings(){
        $user = Auth::user();
        return view('student/settings', compact('user'));
    }
    public function students_page(Request $request) {
        return view('content.students.index');
    }
    public function create_student_page(Request $request) {
        return view('content.students.create');
    }
    public function students_list(Request $request) {
        try{

            $students = EnrollmentStatus::join('students', 'enrollmentstatus.student_no', '=', 'students.student_no')
                                        ->orderBy('enrollmentstatus.yearlevel_id', 'desc')
                                        ->orderBy('students.lastname', 'asc')
                                        ->with(['student', 'course', 'yearLevel', 'section', 'academicYear'])
                                        ->get();

            // Extract unique student numbers from the result
            $uniqueStudentNumbers = $students->unique('student_no');

            return DataTables::of($uniqueStudentNumbers)
            ->addIndexColumn()
            ->addColumn('s_number', function ($row){
                return $row->student->student_no;
            })
            ->addColumn('name', function ($row){
                return ucwords($row->student->lastname).', '.ucwords($row->student->firstname).' '.ucwords($row->student->middlename);
            })
            ->addColumn('course', function ($row){
                return str_replace('Bachelor of Science','BS', $row->course->program);
                // return ucwords($row->lastname).', '.ucwords($row->firstname).' '.ucwords($row->middlename);
            })
            ->addColumn('y_level', function ($row){
                return $row->yearLevel->year_levels;
            })
            ->addColumn('section', function ($row){
                return $row->section->section_name;
            })
            ->addColumn('a_year', function ($row){
                return $row->academicYear->academic_year;
            })
            ->addColumn('classification', function ($row){
                $type = '';
                $student_type = StudentType::find($row->student->type);
                if($student_type) {
                    $type = $student_type->type;
                }
                return $type;
            })
            ->addColumn('status', function ($row){
                return $row->student->status;
            })
            ->addColumn('action', function ($row){
                $link = route('students.view-profile', $row->student->student_no);
                // $link = '';
                $action = '<a href="'.$link.'" type="button" class="btn btn-sm" ><i class="fa-solid fa-eye"></i> </a>';

                return $action;
            })
            ->rawColumns(['s_number','name','course','y_level','section','a_year','classification','status','action'])
            ->make(true);
        }
        catch(\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function student_view_profile($id) {
        $user = Auth::user();

        $studentNum = $id;

        $student = User::where('studentNum', $id)->firstOrFail();

        $info = Student::where('student_no', $student->studentNum)->first();
        $parentGuardian = ParentGuardian::where('student_no', $student->studentNum)->first();
        $educationalBg = EducationalBg::where('student_no', $student->studentNum)->first();
        // $enrollmentStatus = EnrollmentStatus::where('student_no', $student->studentNum)->orderby('registration_date', 'desc')->first();
        $enrollmentStatus = EnrollmentStatus::where('student_no', $student->studentNum)->orderby('year_level', 'desc')->orderBy('term','desc')->first();
        $deficiencies = Deficiencies::where('student_no', $student->studentNum)->get();
        $year = $enrollmentStatus->yearlevel_id;
        $timetable = Timetable::with('subjects', 'sections')
                        ->whereHas('subjects', function($query) use ($year) {
                            $query->where('yearlevel_id', $year);
                        })->get();

        $yearLevel = YearLevels::find($enrollmentStatus->yearlevel_id);
        $course = Courses::find($enrollmentStatus->course_id);
        $section = Sections::find($enrollmentStatus->section_id);
        $studentType = StudentType::find($enrollmentStatus->type_id);
        $status = StudentStatus::find($enrollmentStatus->status_id);
        $backSubject = BackSubjects::find($enrollmentStatus->backsubject_id);
        $professor = Professors::find($enrollmentStatus->prof_id);
        $matchedRequests = Requests::with('user', 'document', 'paymentmethod')->get();

        $academicYear = null;
        $academicTerm = null;

        if ($yearLevel) {
            $academicYear = $yearLevel->academicYear;
        }

        if ($academicYear) {
            $academicTerm = $academicYear->academicTerm;
        }

        $adviser3rd = null;
        $thirdYear = null;
        $thirdSection =null;
        $yearThird = null;
        $termThird = null;

        if ($section && $yearLevel && $yearLevel->id !== 1) {
            if($yearLevel->year_levels === '4th Year' && $academicTerm->academic_term === '2nd Semester' || $yearLevel->year_levels === '3rd Year' && $academicTerm->academic_term === '2nd Semester' || $yearLevel->year_levels === '2nd Year' && $academicTerm->academic_term === '2nd Semester'){
                $adviserSection = Sections::where('yearlevel_id', $yearLevel->id)->first();
                $acadYear = AcademicYear::where('academicterm_id', 1)->first();

                if ($adviserSection) {
                    $adviser3rd = Professors::find($adviserSection->prof_id);
                    $thirdYear = YearLevels::find($adviserSection->yearlevel_id);
                    $thirdSection = Sections::find($adviserSection->id);
                    $yearThird = AcademicYear::find($adviserSection->yearlevel_id);
                    if($yearThird){
                        $termThird = $thirdYear->termThird;
                    }
                }

                if($acadYear){
                    $yearThird = AcademicYear::find($acadYear->id);
                    $termThird = AcademicTerm::find($acadYear->academicterm_id);
                }
            }else if($yearLevel->year_levels === '4th Year' && $academicTerm->academic_term === '1st Semester' || $yearLevel->year_levels === '3rd Year' && $academicTerm->academic_term === '1st Semester' || $yearLevel->year_levels === '2nd Year' && $academicTerm->academic_term === '1st Semester'){
                $adviserSection = Sections::where('yearlevel_id', $yearLevel->id - 1)->first();
                $acadYear = AcademicYear::where('id', $yearLevel->id-1)->first();

                if ($adviserSection) {
                    $adviser3rd = Professors::find($adviserSection->prof_id);
                    $thirdYear = YearLevels::find($adviserSection->yearlevel_id);
                    $thirdSection = Sections::find($adviserSection->id);
                    $yearThird = AcademicYear::find($adviserSection->yearlevel_id);
                    if($yearThird){
                        $termThird = $thirdYear->termThird;
                    }
                }

                if($acadYear){
                    $yearThird = AcademicYear::find($acadYear->id);
                    $termThird = AcademicTerm::find($acadYear->academicterm_id);
                }
            }else if($yearLevel->year_levels === '1st Year' && $academicTerm->academic_term === '2nd Semester'){
                $adviserSection = Sections::where('yearlevel_id', $yearLevel->id)->first();
                $acadYear = AcademicYear::where('academicterm_id', 1)->first();

                if ($adviserSection) {
                    $adviser3rd = Professors::find($adviserSection->prof_id);
                    $thirdYear = YearLevels::find($adviserSection->yearlevel_id);
                    $thirdSection = Sections::find($adviserSection->id);
                    $yearThird = AcademicYear::find($adviserSection->yearlevel_id);
                    if($yearThird){
                        $termThird = $thirdYear->termThird;
                    }
                }

                if($acadYear){
                    $yearThird = AcademicYear::find($acadYear->id);
                    $termThird = AcademicTerm::find($acadYear->academicterm_id);
                }
            }
        }

        $subject = null;

        $backSubjects = [];

        if ($backSubject && $backSubject->subject_id !== 0 && !empty($backSubject->subject_id)) {
            $backSubjectsData = BackSubjects::where('student_no', $student->studentNum)->get();

            foreach ($backSubjectsData as $backSubj) {
                $subject = Subjects::find($backSubj->subject_id);
                if ($subject) {
                    $backSubjects[] = $subject->descriptive_title;
                }
            }
        }

        $subjectForYearLevelMinusOne = null;
        $cGrades2 = null;

        if ($yearLevel) {
            $subjectForYearLevel = Subjects::with('professors', 'grades')
                                    ->where('yearlevel_id', $yearLevel->id)
                                    ->get();

            if ($subjectForYearLevel->isNotEmpty()) {
                $cGrades = Grades::with('subjects')
                        ->where('student_no', $studentNum)
                        ->whereIn('subject_id', $subjectForYearLevel->pluck('id'))
                        ->get();
            }

            if ($yearLevel->id !== 1) {
                if($yearLevel->year_levels === '4th Year' && $academicTerm->academic_term === '2nd Semester' || $yearLevel->year_levels === '3rd Year' && $academicTerm->academic_term === '2nd Semester' || $yearLevel->year_levels === '2nd Year' && $academicTerm->academic_term === '2nd Semester'){
                    $subjectForYearLevelMinusOne = Subjects::with('professors', 'grades')
                                                ->where('academicterm_id', 1)
                                                ->get();

                    if ($subjectForYearLevelMinusOne->isNotEmpty()) {
                        $cGrades2 = Grades::with('subjects')
                            ->where('student_no', $studentNum)
                            ->whereIn('subject_id', $subjectForYearLevelMinusOne->pluck('id'))
                            ->get();
                    }
                }else if($yearLevel->year_levels === '4th Year' && $academicTerm->academic_term === '1st Semester' || $yearLevel->year_levels === '3rd Year' && $academicTerm->academic_term === '1st Semester' || $yearLevel->year_levels === '2nd Year' && $academicTerm->academic_term === '1st Semester'){
                    $subjectForYearLevelMinusOne = Subjects::with('professors', 'grades')
                                                ->where('yearlevel_id', $yearLevel->id-1)
                                                ->get();

                    if ($subjectForYearLevelMinusOne->isNotEmpty()) {
                        $cGrades2 = Grades::with('subjects')
                            ->where('student_no', $studentNum)
                            ->whereIn('subject_id', $subjectForYearLevelMinusOne->pluck('id'))
                            ->get();
                    }
                }else if($yearLevel->year_levels === '1st Year' && $academicTerm->academic_term === '2nd Semester'){
                    $subjectForYearLevelMinusOne = Subjects::with('professors', 'grades')
                                                ->where('academicterm_id', 1)
                                                ->get();

                    if ($subjectForYearLevelMinusOne->isNotEmpty()) {
                        $cGrades2 = Grades::with('subjects')
                            ->where('student_no', $studentNum)
                            ->whereIn('subject_id', $subjectForYearLevelMinusOne->pluck('id'))
                            ->get();
                    }
                }
            }
        }

        $enrollment_records = EnrollmentStatus::where('student_no', $info->student_no)->get();

        // return view('registrar/student-profile', compact(
        return view('content.registrar.student-profile', compact(
            'user',
            'student',
            'info',
            'parentGuardian',
            'educationalBg',
            'enrollmentStatus',
            'yearLevel',
            'course',
            'section',
            'studentType',
            'status',
            'backSubjects',
            'professor',
            'subject',
            'subjectForYearLevel',
            'cGrades',
            'subjectForYearLevelMinusOne',
            'cGrades2',
            'academicYear',
            'academicTerm',
            'adviser3rd',
            'thirdYear',
            'thirdSection',
            'yearThird',
            'termThird',
            'matchedRequests',
            'timetable',
            'deficiencies',
            'enrollment_records'
        ));
    }

    public function student_view_profile_request(Request $request) {
        Session::flash('saved-session-tab', '5');
        return redirect()->route('students.view-profile', $request->id);
        // dd($request->all());
        return $this->student_view_profile($request->id);
    }
    public function count_gender() {
        // $male = EnrollmentStatus::join('students','students.student_no','enrollmentstatus.student_no')->select('gender')->where('gender','female')->get()->count();
        // $female = EnrollmentStatus::join('students','students.student_no','enrollmentstatus.student_no')->select('gender')->where('gender','male')->get()->count();
        $count_male = $this->count_enrolled_by_gender('female');
        dd($count_male);
    }
    public function count_enrolled_by_gender($gender) {
        $count = EnrollmentStatus::join('students','students.student_no','enrollmentstatus.student_no')
                                ->select('students.gender','enrollmentstatus.status')
                                ->where([
                                    'gender' => $gender,
                                    'enrollmentstatus.status' => 'enrolled'
                                    ])
                                ->get()->count();
        return $count;
    }
    public function count_notif(Request $request) {
        $notifications = \App\Models\Notifications::where('student_no', Auth::user()->studentNum)->orderBy('id','desc')->get();
        $count_unread = \App\Models\Notifications::where('student_no', Auth::user()->studentNum)->where('read', NULL)->get()->count();

        return view('content.registrar.render.count-notification', compact('notifications','count_unread'));
    }
    public function show_notif(Request $request) {
        $notif = Notifications::find($request->id);
        $data = json_decode($notif->data);
        $message = $data->message;
        $data = [
            'type' => $notif->type,
            'message' => $message,
        ];

        Notifications::find($request->id)->update(['read'=>'1']);
        return view('content.registrar.render.notification-body', compact('data'));
    }
    public function get_sections(Request $request) {
        $sections = DB::table('sections')->join('professors','professors.id','sections.prof_id')
                        ->where(['yearlevel_id' => $request->year_level, 'course_id' => $request->course_id])
                        ->select('sections.*','professors.full_name')
                        ->get();

        return $sections;
        return $request->all();
    }
    public function save_enrollment(Request $request) {
        $enrolled_student = EnrollmentStatus::where([
            'student_no' => $request->student_number,
            'year_level' => $request->level,
            'term' => $request->term,
        ])->first();

        if($enrolled_student) {
            $update_student = EnrollmentStatus::find($enrolled_student->id)->update([
                'registration_date' => $request->date_registered,
                'yearlevel_id' => $request->yearlevel_id,
                'course_id' => $request->course_id,
                'section_id' => $request->section,
                'type_id' => $request->student_type,
                'status_id' => $request->student_status,
                'prof_id' => $request->prof_id,
                'academic_year' => $request->academic_year,
            ]);
            if($update_student) {
                Session::flash('message', 'Student enrollment status has been updated.');
            }
            else {
                Session::flash('error-message', 'something went wrong.');
            }
        }
        else {
            $enrollment = new EnrollmentStatus();
            $enrollment->student_no = $request->student_number;
            $enrollment->registration_date = $request->date_registered;
            $enrollment->yearlevel_id = $request->yearlevel_id;
            $enrollment->course_id = $request->course_id;
            $enrollment->section_id = $request->section;
            $enrollment->type_id = $request->student_type;
            $enrollment->status_id = $request->student_status;
            $enrollment->backsubject_id = 0;
            $enrollment->prof_id = $request->prof_id;
            $enrollment->status = 'Enrolled';
            $enrollment->academic_year = $request->academic_year;
            $enrollment->year_level = $request->level;
            $enrollment->term = $request->term;

            if($enrollment->save()) {
                Session::flash('message', 'Student enrollment status has been updated.');
            }
            else {
                Session::flash('error-message', 'something went wrong.');
            }
        }

        Session::flash('saved-session-tab', '2');
        return back();
    }
    public function marked_graduated(Request $request) {
        // dd($request->all());
        if($request->marked_status == 'graduated') {
            Graduate::create([
                'student_no'  => $request->student_number,
                'date_admitted'  => $request->date_admitted,
                'date_graduated'  => $request->date_graduated,
            ]);
            Session::flash('message', 'Student has been marked as graduated.');
        }
        else {
            Graduate::where('student_no', $request->student_number)->delete();
            Session::flash('message', 'Student has been unmarked as graduated.');
        }
        Session::flash('saved-session-tab', '2');
        return back();
    }
}
