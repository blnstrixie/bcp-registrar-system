<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Mail\Emailer;
use App\Models\User;
use App\Models\Student;
use App\Models\Courses;
use App\Models\Requests;
use App\Models\EnrollmentStatus;
use App\Models\ParentGuardian;
use App\Models\SubjectsEnrolled;
use App\Models\EducationalBg;
use App\Models\Grades;
use App\Models\YearLevels;
use App\Models\Sections;
use App\Models\StudentType;
use App\Models\StudentStatus;
use App\Models\BackSubjects;
use App\Models\Professors;
use App\Models\Subjects;
use App\Models\AcademicTerm;
use App\Models\AcademicYear;
use App\Models\Timetable;
use App\Models\Deficiencies;
use App\Models\Documents;
use App\Models\PaymentMethod;
use App\Models\Notifications;
use App\Models\AuditTrail;
use Session;
use DB;
use DataTables;

class RegistrarController extends Controller
{
    public function fetch_section(Request $request) {
        $sections = Sections::where('yearlevel_id', $request->y_level)->where('course_id', $request->c_id)->get();
        $subjects = Subjects::where('yearlevel_id', $request->y_level)->where('academicterm_id', $request->t_id)->get();
        return response()->json(['sections' => $sections, 'subjects' => $subjects]);
    }
    public function documents_page() {
        return view('content.registrar.documents');
    }
    public function fetch_students(Request $request) {

        try{
            $students = Student::get();

            return DataTables::of($students)
            ->addIndexColumn()
            ->addColumn('stud_no', function ($row){
                return $row->student_no;
            })
            ->addColumn('name', function ($row){
                return ucwords($row->lastname).', '.ucwords($row->firstname).' '.ucwords($row->middlename);
            })
            ->addColumn('action', function ($row){
                $link = route('documents.show-tor', $row->student_no);
                return '<a href="'.$link.'" target="_blank" type="button" class="btn btn-sm btn-link" >View </a>';
            })
            ->rawColumns(['stud_no','name','action'])
            ->make(true);
        }
        catch(\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function show_tor($id){
        // $id = decrypt($id);

        // NEW
        // dd($id);

        $enrollments = EnrollmentStatus::where('student_no', $id)
                                    ->get()->sortBy([['yearlevel_id', 'asc'], ['term', 'asc']]);

        if(count($enrollments) < 1) {
            abort(404);
        }
        // dd($enrollments);

        $user = User::where('studentNum', $id)->first();
        $acads_year = Grades::select('acad_year')
        ->distinct()
        ->where('student_no', $user->studentNum)
        ->get()
        ->pluck('acad_year')
        ->groupBy(function ($item) {
            return $item;
        })
        ->toArray();

        // dd($grades);
        if($user->role == 'Student') {

            $latestGrades = Grades::select('id','student_no', 'subject_id')->groupBy(['id','student_no', 'subject_id'])
            ->latest('created_at')
            ->get();

            $latestGrades = Grades::join('subjects','subjects.id','grades.subject_id')->whereIn('grades.id', function($query) use ($user)  {
                $query->select(DB::raw('MAX(id)'))
                    ->where('student_no', $user->studentNum)->from('grades')
                    ->groupBy(['student_no', 'subject_id']);
            })
            ->orderBy('subjects.academicterm_id', 'asc')
            ->orderBy('subjects.yearlevel_id', 'asc')->get();

            // dd($latestGrades);

            return view('content.documents.TOR', compact('user','latestGrades','acads_year','enrollments'));
        }
        Session::flash('error-message', 'Student not found.');
        return redirect()->back();

    }
    // public function show_tor($id){
    //     // $id = decrypt($id);
    //     $user = User::where('studentNum', $id)->first();
    //     $acads_year = Grades::select('acad_year')
    //     ->distinct()
    //     ->where('student_no', $user->studentNum)
    //     ->get()
    //     ->pluck('acad_year')
    //     ->groupBy(function ($item) {
    //         return $item;
    //     })
    //     ->toArray();

    //     // dd($grades);
    //     if($user->role == 'Student') {

    //         $latestGrades = Grades::select('id','student_no', 'subject_id')->groupBy(['id','student_no', 'subject_id'])
    //         ->latest('created_at')
    //         ->get();

    //         $latestGrades = Grades::join('subjects','subjects.id','grades.subject_id')->whereIn('grades.id', function($query) use ($user)  {
    //             $query->select(DB::raw('MAX(id)'))
    //                 ->where('student_no', $user->studentNum)->from('grades')
    //                 ->groupBy(['student_no', 'subject_id']);
    //         })
    //         ->orderBy('subjects.academicterm_id', 'asc')
    //         ->orderBy('subjects.yearlevel_id', 'asc')->get();

    //         // dd($latestGrades);

    //         return view('content.documents.TOR', compact('user','latestGrades','acads_year'));
    //     }
    //     Session::flash('error-message', 'Student not found.');
    //     return redirect()->back();

    // }
    public function index(){
        $user = Auth::user();

        $studentUserCount = User::where('role', 'Student')->count();

        $studentTableCount = Student::count();
        $totalCourseCount = Courses::count();
        $totalRequestsCount = Requests::where('status', '!=', 'Finished')->count();

        $mergedStudentCount = User::where('role', 'Student')
            ->whereExists(function ($query) {
                $query->select(Student::raw(1))
                    ->from('students')
                    ->whereColumn('students.student_no', 'users.studentNum');
            })->count();

        $totalStudentCount = $studentUserCount + $studentTableCount - $mergedStudentCount;

        $requests = Requests::select('requests.*', 'users.firstname', 'users.middlename', 'users.lastname')
        ->join('users', function ($join) {
            $join->on('requests.studentNum', '=', 'users.studentNum')
                 ->where('users.role', '=', 'Student');
        })
        ->get();

        return view('registrar/dashboard', compact('user', 'totalStudentCount', 'totalCourseCount', 'totalRequestsCount', 'requests'));
    }


    public function regstud(){
        $user = Auth::user();

        $users = User::with('student')->get();
        $student = Student::with('user')->get();

        $enrollmentStatus = EnrollmentStatus::with('student', 'course', 'yearLevel', 'section', 'academicYear')->get();
        $subjects = Subjects::with(['professors', 'yearLevel', 'section', 'grades' => function ($query) {
            $query->whereNotNull('subject_id');
        }])->whereHas('grades', function ($query) {
            $query->whereNotNull('subject_id');
        })->get();
        return view('registrar/students', compact('user', 'users', 'student', 'enrollmentStatus'));
    }

    public function courses() {
        return redirect()->route('courses');
        $user = Auth::user();
        $course = Courses::withCount('enrollmentStatuses')
                    ->with(['yearLevels' => function ($query) {
                        $query->withCount('enrollmentStatuses');
                    }])
                    ->get();
        $courses = Courses::pluck('program');
        $yearLevels = YearLevels::distinct()->pluck('year_levels');

        return view('registrar/courses', compact('user', 'course', 'courses', 'yearLevels'));
    }

    public function grades(){
        return redirect()->route('grades-list');
        $user = Auth::user();
        $courses = Courses::pluck('program');
        $yearLevels = YearLevels::distinct()->pluck('year_levels');
        $sections = Sections::pluck('section_name');

        $subjects = Subjects::with(['professors', 'yearLevel', 'section', 'grades' => function ($query) {
            $query->whereNotNull('subject_id');
        }])->whereHas('grades', function ($query) {
            $query->whereNotNull('subject_id');
        })->get();

        return view('registrar/grades', compact('user', 'subjects', 'courses', 'yearLevels', 'sections'));
    }

    public function report(){
        $user = Auth::user();

        $totalEnrollmentCount = EnrollmentStatus::where('status', 'Enrolled')->count();

        $studentsPerCourse = EnrollmentStatus::with('course')
            ->select('course_id', EnrollmentStatus::raw('COUNT(*) as total_students'))
            ->where('status', 'Enrolled')
            ->groupBy('course_id')
            ->get();

        $studentsPerYearLevel = EnrollmentStatus::with('yearLevel')
            ->select('yearlevel_id', EnrollmentStatus::raw('COUNT(*) as total_students'))
            ->where('status', 'Enrolled')
            ->groupBy('yearlevel_id')
            ->get();

        $courses = Courses::pluck('program', 'id');
        $yearLevels = YearLevels::pluck('year_levels', 'id');


        $enrolled_male = $this->count_enrolled_by_gender('male', '2023');
        $enrolled_female = $this->count_enrolled_by_gender('female','2023');

        return view('registrar/report', compact('user','totalEnrollmentCount', 'studentsPerCourse', 'studentsPerYearLevel', 'courses', 'yearLevels','enrolled_male','enrolled_female'));
    }

    //Modifed

    public function audittrail(){
        $user = Auth::user();

        $audit_logs = AuditTrail::get();

        return view('registrar/audit-trail', compact('user','audit_logs'));
    }

    public function studentslistpercourse(){
        $user = Auth::user();

        return view('registrar/students-list-course', compact('user'));
    }

    public function studentslistperyearlevel(){
        $user = Auth::user();

        return view('registrar/students-list-yearlevel', compact('user'));
    }

    public function studentslistpergender(){
        $user = Auth::user();

        return view('registrar/students-list-gender', compact('user'));
    }

    public function gradereport(){
        $user = Auth::user();

        $enrollmentStatus = EnrollmentStatus::with('student', 'course', 'yearLevel', 'section', 'grades')->get();

        return view('registrar/grade-report', compact('user', 'enrollmentStatus'));
    }

    public function printoverallgradereport(){
        $enrollmentStatus = EnrollmentStatus::with('student', 'course', 'yearLevel', 'section', 'grades')->get();

        return view('prints/overall-gradereport', compact('enrollmentStatus'));
    }

    public function printpercoursegradereport(){
        $enrollmentStatus = EnrollmentStatus::with('student', 'course', 'yearLevel', 'section', 'grades')->get();

        return view('prints/percourse-gradereport', compact('enrollmentStatus'));
    }

    public function printperyearlevelgradereport(){
        $enrollmentStatus = EnrollmentStatus::with('student', 'course', 'yearLevel', 'section', 'grades')->get();

        return view('prints/peryearlevel-gradereport', compact('enrollmentStatus'));
    }

    public function accounts(){
        $user = Auth::user();

        $users = User::with('student')->get();
        $student = Student::with('user')->get();
        $studentNum = Student::all();
        $YearLevels = YearLevels::with('course')->get();
        return view('registrar/accounts', compact('user', 'users', 'student', 'studentNum', 'YearLevels'));
    }

    public function getStudentInfo($studentNum) {
        $student = Student::where('student_no', $studentNum)->first();
        return response()->json($student);
    }

    public function courseInfo($id){
        $user = Auth::user();
        $course = Courses::find($id);

        $enrolledCount = EnrollmentStatus::where('course_id', $id)
                        ->where('status', 'Enrolled')
                        ->count();

        return view('registrar/course-information', compact('user', 'course', 'enrolledCount'));
    }

    public function perYear($id, $year) {
        $user = Auth::user();
        $course = Courses::find($id);

        $sections = Sections::where('course_id', $id)
                            ->where('yearlevel_id', $year)
                            ->get();

        $professors = [];
        $subjects = [];

        if($sections->isNotEmpty()) {
            $sectionIds = $sections->pluck('yearlevel_id')->toArray();
            $subjects = Subjects::whereIn('yearlevel_id', $sectionIds)->get();

            $professors = Professors::whereIn('id', $subjects->pluck('prof_id'))->get();
        }

        return view('registrar/year-level', compact('user', 'course', 'sections', 'professors', 'subjects', 'year'));
    }

    public function printTor($studentNum){
        $student = User::where('studentNum', $studentNum)->firstOrFail();

        $info = Student::where('student_no', $student->studentNum)->first();
        $enrollmentStatus = EnrollmentStatus::where('student_no', $student->studentNum)->first();
        $grades = Grades::where('student_no', $enrollmentStatus->student_no)->first();

        $yearLevel = YearLevels::find($enrollmentStatus->yearlevel_id);
        $acadYear = AcademicYear::where('id', $yearLevel->id)->first();
        $cYear = AcademicYear::find($acadYear->id);
        $cTerm = AcademicTerm::find($acadYear->academicterm_id);
        $course = Courses::find($enrollmentStatus->course_id);
        $cGrades = Grades::with('subjects')
                        ->where('student_no', $enrollmentStatus->student_no)
                        ->get();
        return view('prints/tor', compact('student', 'info', 'enrollmentStatus', 'yearLevel', 'cYear', 'cTerm', 'course', 'enrollmentStatus', 'course', 'cGrades'));
    }

    public function gradeSheet($studentNum, $year){
        $student = User::where('studentNum', $studentNum)->firstOrFail();

        $info = Student::where('student_no', $student->studentNum)->first();
        $grades = Grades::where('student_no', $student->studentNum)->first();

        $yearLevel = YearLevels::find($year);
        $acadYear = AcademicYear::where('id', $yearLevel->id)->first();
        $cYear = AcademicYear::find($acadYear->id);
        $cTerm = AcademicTerm::find($acadYear->academicterm_id);
        $enrollmentStatus = EnrollmentStatus::where('student_no', $student->studentNum)->first();
        $section = Sections::find($enrollmentStatus->section_id);
        $subjects = Subjects::with('professors', 'grades')
                            ->where('yearlevel_id', $yearLevel->id)
                            ->get();
        $cGrades = Grades::with('subjects')
                        ->where('student_no', $studentNum)
                        ->whereIn('subject_id', $subjects->pluck('id'))
                        ->get();

        return view('prints/grade-sheet', compact('student', 'info', 'grades', 'yearLevel', 'acadYear', 'cYear', 'cTerm', 'section', 'cGrades'));
    }

    public function printCor($studentNum){
        $student = User::where('studentNum', $studentNum)->firstOrFail();

        $info = Student::where('student_no', $student->studentNum)->first();
        $enrollmentStatus = EnrollmentStatus::where('student_no', $student->studentNum)->first();

        $yearLevel = YearLevels::find($enrollmentStatus->yearlevel_id);
        $acadYear = AcademicYear::where('id', $yearLevel->id)->first();
        $cYear = AcademicYear::find($acadYear->id);
        $cTerm = AcademicTerm::find($enrollmentStatus->term);
        $course = Courses::find($enrollmentStatus->course_id);
        $year = $enrollmentStatus->yearlevel_id;
        $timetable = Timetable::with('subjects', 'sections')
                        ->whereHas('subjects', function($query) use ($year) {
                            $query->where('yearlevel_id', $year);
                        })->get();
        return view('prints/cor', compact('student', 'info', 'enrollmentStatus', 'yearLevel', 'cYear', 'cTerm', 'course', 'enrollmentStatus', 'timetable'));
    }

    public function settings(){
        $user = Auth::user();

        $totalUsers = User::sum('id');
        $users = User::with('student')->get();
        $student = Student::with('user')->get();
        $documents = Documents::all();
        $paymentmethod = PaymentMethod::all();
        return view('registrar/settings', compact('user', 'users', 'student', 'totalUsers', 'documents', 'paymentmethod'));
    }

    public function method(Request $request){
        $input = $request->all();

        if ($request->hasFile('qr_code')) {
            $qrcode = $request->file('qr_code');
            if ($qrcode->isValid()) {
                $qrcode->move('qrcode', $qrcode->getClientOriginalName());
                $input['qr_code'] = 'qrcode/' . $qrcode->getClientOriginalName();
            } else {
                return redirect('registrar/settings')->with('error', 'Invalid file uploaded.');
            }
        } else {
            $input['qrcode'] = null;
        }

        PaymentMethod::create($input);
        return redirect('registrar/settings')->with('success', 'Successfully Added.');
    }

    public function documents(Request $request){
        $input = $request->all();
        Documents::create($input);
        return redirect('registrar/settings')->with('success', 'Successfully Added.');
    }

    public function store(Request $request){
        $input = $request->all();
        User::create($input);
        return redirect('registrar/settings')->with('success', 'Successfully Added.');
    }

    public function storeStud(Request $request){
        $input = $request->all();

        if (empty($input['yearlevel_id'])) {
            return redirect()->back()->with('error', 'Year Level is required')->withErrors(['yearlevel_id' => 'Year Level is required'])->withInput();
        }

        $user = User::create($input);

        $yearlevel_id = $input['yearlevel_id'];
        $selectedYearLevel = YearLevels::find($yearlevel_id);

        $type = ($yearlevel_id >= 1) ? 1 : 2;

        $sections = Sections::where('yearlevel_id', $yearlevel_id)->first();

        $enrollmentStatus = EnrollmentStatus::create([
            'student_no' => $input['studentNum'],
            'yearlevel_id' => $selectedYearLevel->id,
            'course_id' => $selectedYearLevel->course_id,
            'section_id'=> $sections->id,
            'type_id'=> $type,
            'status_id'=> 1,
            'backsubject_id'=> 0,
            'prof_id'=>$sections->prof_id,
            'status' => 'Enrolled',
        ]);

        $subj = Subjects::where('yearlevel_id', $yearlevel_id)->first();
        $yearLevel = YearLevels::find($subj->yearlevel_id);

        $academicYear = null;
        $academicTerm = null;

        if ($yearLevel) {
            $academicYear = $yearLevel->academicYear;
        }

        if ($academicYear) {
            $academicTerm = $academicYear->academicTerm;
        }

        if ($yearLevel) {
            if($yearLevel->year_levels === '4th Year' && $academicTerm->academic_term === '2nd Semester' || $yearLevel->year_levels === '3rd Year' && $academicTerm->academic_term === '2nd Semester' || $yearLevel->year_levels === '2nd Year' && $academicTerm->academic_term === '2nd Semester'){
                $subjects = Subjects::where('yearlevel_id', $yearLevel->id)->get();
                foreach ($subjects as $subject) {
                    Grades::create([
                        'student_no' => $input['studentNum'],
                        'subject_id' => $subject->id,
                        'prelim_grade'=> 0,
                        'midterm_grade'=> 0,
                        'final_grade'=> 0,
                        'gwa'=> 0,
                    ]);
                }
            }else if($yearLevel->year_levels === '4th Year' && $academicTerm->academic_term === '1st Semester' || $yearLevel->year_levels === '3rd Year' && $academicTerm->academic_term === '1st Semester' || $yearLevel->year_levels === '2nd Year' && $academicTerm->academic_term === '1st Semester'){
                $subjects = Subjects::where('yearlevel_id', $yearLevel->id)->get();

                foreach ($subjects as $subject) {
                    Grades::create([
                        'student_no' => $input['studentNum'],
                        'subject_id' => $subject->id,
                        'prelim_grade'=> 0,
                        'midterm_grade'=> 0,
                        'final_grade'=> 0,
                        'gwa'=> 0,
                    ]);
                }
            }else if($yearLevel->year_levels === '1st Year'){
                $subjects = Subjects::where('yearlevel_id', $yearLevel->id)->get();

                foreach ($subjects as $subject) {
                    Grades::create([
                        'student_no' => $input['studentNum'],
                        'subject_id' => $subject->id,
                        'prelim_grade'=> 0,
                        'midterm_grade'=> 0,
                        'final_grade'=> 0,
                        'gwa'=> 0,
                    ]);
                }
            }
        }

        return redirect('registrar/accounts')->with('success', 'Successfully Added.');
    }

    public function destroyStud($id)
    {
        $user = User::findOrFail($id);
        $studentNum = $user->studentNum;

        EnrollmentStatus::where('student_no', $studentNum)->delete();
        Grades::where('student_no', $studentNum)->delete();

        $user->delete();

        return redirect('registrar/accounts')->with('success', 'Deleted Successfully.');
    }

    public function profile(Request $request, $id) {
        $userProf = User::find($id);

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            if ($avatar->isValid()) {
                $avatar->move('avatars', $avatar->getClientOriginalName());
                $userProf->avatar = 'avatars/' . $avatar->getClientOriginalName();
            } else {
                return redirect('registrar/settings')->with('error', 'Invalid file uploaded.');
            }
        }

        $input = $request->except('avatar');
        $userProf->update($input);

        return redirect('registrar/settings')->with('success', 'Updated Successfully.');
    }

    public function account(Request $request, $id) {
        $userProf = User::find($id);

        $updatingUsernameEmail = $request->filled('username') || $request->filled('email');
        $currentPasswordProvided = $request->filled('current');

        if ($updatingUsernameEmail && $currentPasswordProvided) {
            $currentPassword = $request->input('current');
            if (!password_verify($currentPassword, $userProf->password)) {
                return redirect('registrar/settings')->with('error', 'Current password is incorrect.');
            }
        }

        $userProf->emailAdd = $request->input('email', $userProf->emailAdd);
        $userProf->username = $request->input('username', $userProf->username);

        $updatingPassword = $request->filled('new-password') || $request->filled('confirm-password');

        if ($updatingPassword) {
            $newPassword = $request->input('new-password');
            $confirmPassword = $request->input('confirm-password');

            if ($newPassword !== $confirmPassword) {
                return redirect('registrar/settings')->with('error', 'New password and confirm password do not match.');
            }

            $userProf->password = $newPassword;
        }

        if ($userProf->isDirty()) {
            $userProf->save();
            return redirect('registrar/settings')->with('success', 'Updated Successfully.');
        }

        return redirect('registrar/settings')->with('success', 'No changes detected.');
    }

    public function destroy($id){
        User::destroy($id);
        return redirect('registrar/settings')->with('success', 'Deleted Successfully.');
    }

    public function destroyDocs($id){
        Documents::destroy($id);
        return redirect()->route('registrar/settings')->with('success', 'Deleted Successfully.');
    }

    public function destroyMethod($id){
        PaymentMethod::destroy($id);
        return redirect()->route('registrar/settings')->with('success', 'Deleted Successfully.');
    }

    public function accept($id)
    {
        $user = User::findOrFail($id);
        $user->role = 'Student';

        $template = 'emails.demoMail';

        $mailData = [
            'subject' => 'Your Role Has Been Updated to Student',
            'title' => 'Role Update Notification',
        ];

        Mail::to($user->emailAdd)->send(new Emailer($mailData, $template));

        $user->save();

        return redirect('registrar/accounts')->with('success', 'Role Updated Successfully. Email Sent.');
    }

    public function reject($id)
    {
        $user = User::findOrFail($id);
        $user->role = 'Rejected';

        $template = 'emails.rejectMail';

        $mailData = [
            'subject' => 'Application Rejection Notification',
            'title' => 'Application Rejection Notification',
            'body' => $user->firstname,
        ];

        Mail::to($user->emailAdd)->send(new Emailer($mailData, $template));

        $user->save();

        return redirect('registrar/accounts')->with('success', 'Application Rejected Successfully.');
    }

    public function timetable($id, $year){
        $user = Auth::user();
        $course = Courses::find($id);
        $year = $year;
        $timetable = Timetable::with('subjects', 'sections')
                        ->whereHas('subjects', function($query) use ($year) {
                            $query->where('yearlevel_id', $year);
                        })->get();

        return view('registrar/timetable', compact('user', 'course', 'timetable', 'year'));
    }

    public function viewStudentProfile($studentNum){
        $user = Auth::user();

        $student = User::where('studentNum', $studentNum)->firstOrFail();

        $info = Student::where('student_no', $student->studentNum)->first();
        $parentGuardian = ParentGuardian::where('student_no', $student->studentNum)->first();
        $educationalBg = EducationalBg::where('student_no', $student->studentNum)->first();
        $enrollmentStatus = EnrollmentStatus::where('student_no', $student->studentNum)->first();
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

        return view('registrar/student-profile', compact(
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
            'deficiencies'
        ));
    }

    public function update(Request $request, $Id){
        $grade = Grades::findOrFail($Id);

        $grade->prelim_grade = $request->input('prelim_grade');
        $grade->midterm_grade = $request->input('midterm_grade');
        $grade->final_grade = $request->input('final_grade');
        $grade->save();

        return redirect()->back()->with('success', 'Grades updated successfully');
    }

    public function studList()
    {
        $students = Student::with('enrollmentStatus.yearLevel', 'enrollmentStatus.course', 'enrollmentStatus.section', 'enrollmentStatus.academicYear')->get();

        return view('prints/students-list', compact('students'));
    }

    public function reportPrint()
    {
        $totalEnrollmentCount = EnrollmentStatus::where('status', 'Enrolled')->count();

        $studentsPerCourse = EnrollmentStatus::with('course')
            ->select('course_id', EnrollmentStatus::raw('COUNT(*) as total_students'))
            ->where('status', 'Enrolled')
            ->groupBy('course_id')
            ->get();

        $studentsPerYearLevel = EnrollmentStatus::with('yearLevel')
            ->select('yearlevel_id', EnrollmentStatus::raw('COUNT(*) as total_students'))
            ->where('status', 'Enrolled')
            ->groupBy('yearlevel_id')
            ->get();

        $courses = Courses::pluck('program', 'id');
        $yearLevels = YearLevels::pluck('year_levels', 'id');

        $enrolled_male = $this->count_enrolled_by_gender('male','2023');
        $enrolled_female = $this->count_enrolled_by_gender('female','2023');
        $data = [
            'totalEnrollmentCount' => $totalEnrollmentCount,
            'studentsPerCourse' => $studentsPerCourse,
            'studentsPerYearLevel' => $studentsPerYearLevel,
            'courses' => $courses,
            'yearLevels' => $yearLevels,
            'enrolledMale' => $enrolled_male,
            'enrolledFemale' => $enrolled_female
        ];
        return view('prints/report', compact('data'));
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
            'paymentProof' => $request->paymentProof ?? null,
        ]);
    }

    public function paymentProof($id){
        $request = Requests::where('id', $id)->firstOrFail();

        $imageUrl = $request->paymentProof;

        return view('partials/proof', compact('imageUrl'));
    }

    public function notifications(Request $request){
        $input = $request->all();
        Deficiencies::create($input);
        return redirect('registrar/dashboard')->with('success', 'Successfully Added.');
    }

    public function Pending(Request $req, $id){
        $request = Requests::findOrFail($id);

        $request->update([
            'registrar_message' => $req->input('message'),
            'status' => 'In-Process',
        ]);

        $data = [
            'message' => $req->input('message'),
            'status'  => 'In-Process',
        ];

        Notifications::create([
            'student_no' => $request->studentNum,
            'type' => 'request',
            'data' => json_encode($data),
            'status' => true,
        ]);

        Session::flash('message', 'Request document updated successfully.');
        Session::flash('saved-session-tab', '5');
        return back();

        return redirect('registrar/dashboard')->with('success', 'Request updated successfully.');
    }
    public function Process(Request $req, $id){
        $request = Requests::findOrFail($id);

        $request->update([
            'status' => 'Finished',
        ]);

        $data = [
            'message' => 'Your requested document has been completed.',
            'status'  => 'Finished',
        ];

        Notifications::create([
            'student_no' => $request->studentNum,
            'type' => 'request',
            'data' => json_encode($data),
            'status' => true,
        ]);

        Session::flash('message', 'Request document updated successfully.');
        Session::flash('saved-session-tab', '5');
        return back();
        return redirect('registrar/dashboard')->with('success', 'Request updated successfully.');
    }

    public function storeDef(Request $request){
        $input = $request->all();
        Deficiencies::create($input);
        // student_no
        // document
        // deadline
        $data = [
            'message' => 'Please submit your deficiency. Document: '.$request->document.'. Deadline: '.$request->deadline,
        ];
        Notifications::create([
            'student_no' => $request->student_no,
            'type' => 'deficiencies',
            'data' => json_encode($data),
            'status' => true,
        ]);

        Session::flash('message', 'Student Deficiency has been added.');
        Session::flash('saved-session-tab', '6');
        return back();
        return redirect('registrar/dashboard')->with('success', 'Successfully Added.');
    }

    public function destroyDef($id){
        Deficiencies::destroy($id);

        Session::flash('message', 'Student Deficiency has been deleted.');
        Session::flash('saved-session-tab', '6');
        return redirect()->back();
        return redirect('registrar/dashboard')->with('success', 'Deleted Successfully.');
    }
    public function completed_defeciency($id){
        $def = Deficiencies::find($id);

        Session::flash('message', 'Student Deficiency has been completed.');
        Session::flash('saved-session-tab', '6');
        return redirect()->back();
        return redirect('registrar/dashboard')->with('success', 'Deleted Successfully.');
    }

    public function enrollment_reports(Request $request) {
        $user = Auth::user();

        $min_ay = EnrollmentStatus::min('academic_year');
        $max_ay = EnrollmentStatus::max('academic_year');

        $academic_year = $max_ay;
        if($request->year) {
            $academic_year = $request->year;
        }

        $totalEnrollmentCount = EnrollmentStatus::where('status', 'Enrolled')
        ->where('academic_year',$academic_year)->count();

        $studentsPerCourse = EnrollmentStatus::with('course')
            ->select('course_id', EnrollmentStatus::raw('COUNT(*) as total_students'))
            ->where('status', 'Enrolled')
            ->where('academic_year',$academic_year)
            ->groupBy('course_id')
            ->get();

        $studentsPerYearLevel = EnrollmentStatus::with('yearLevel')
            ->select('yearlevel_id', EnrollmentStatus::raw('COUNT(*) as total_students'))
            ->where('status', 'Enrolled')
            ->where('academic_year',$academic_year)
            ->groupBy('yearlevel_id')
            ->get();

        $first = EnrollmentStatus::where(['year_level' => 1, 'academic_year' => $academic_year])->get()->count();
        $second = EnrollmentStatus::where(['year_level' => 2, 'academic_year' => $academic_year])->get()->count();
        $third = EnrollmentStatus::where(['year_level' => 3, 'academic_year' => $academic_year])->get()->count();
        $fourth = EnrollmentStatus::where(['year_level' => 4, 'academic_year' => $academic_year])->get()->count();

        $year_level_count = [
            'first' => $first,
            'second' => $second,
            'third' => $third,
            'fourth' => $fourth,
        ];


        $courses = Courses::pluck('program', 'id');
        $yearLevels = YearLevels::pluck('year_levels', 'id');


        $enrolled_male = $this->count_enrolled_by_gender('male', $academic_year);
        $enrolled_female = $this->count_enrolled_by_gender('female', $academic_year);

        return view('content.registrar.enrollment-report', compact('user','academic_year','min_ay','max_ay','totalEnrollmentCount', 'studentsPerCourse', 'studentsPerYearLevel', 'courses', 'yearLevels','year_level_count','enrolled_male','enrolled_female'));
    }
    public function enrollment_reports_print($year) {
        $academic_year = $year;

        $totalEnrollmentCount = EnrollmentStatus::where('status', 'Enrolled')->where('academic_year', $academic_year)->count();

        $studentsPerCourse = EnrollmentStatus::with('course')
            ->select('course_id', EnrollmentStatus::raw('COUNT(*) as total_students'))
            ->where('status', 'Enrolled')
            ->where('academic_year', $academic_year)
            ->groupBy('course_id')
            ->get();

        $studentsPerYearLevel = EnrollmentStatus::with('yearLevel')
            ->select('yearlevel_id', EnrollmentStatus::raw('COUNT(*) as total_students'))
            ->where('status', 'Enrolled')
            ->where('academic_year', $academic_year)
            ->groupBy('yearlevel_id')
            ->get();

        $courses = Courses::pluck('program', 'id');
        $yearLevels = YearLevels::pluck('year_levels', 'id');

        $enrolled_male = $this->count_enrolled_by_gender('male', $academic_year);
        $enrolled_female = $this->count_enrolled_by_gender('female', $academic_year);
        $data = [
            'totalEnrollmentCount' => $totalEnrollmentCount,
            'studentsPerCourse' => $studentsPerCourse,
            'studentsPerYearLevel' => $studentsPerYearLevel,
            'courses' => $courses,
            'yearLevels' => $yearLevels,
            'enrolledMale' => $enrolled_male,
            'enrolledFemale' => $enrolled_female
        ];
        return view('content.registrar.print-enrollment-report', compact('data','academic_year'));
    }
    public function students_per_course () {
        return view('content.registrar.render.students')->render();
    }
    public function students_per_year_level () {
        return view('content.registrar.render.students')->render();
    }
    public function students_per_gender () {
        return view('content.registrar.render.students')->render();
    }
    public function enrollment_reports_show_students(Request $request) {
        $students = EnrollmentStatus::join('students','students.student_no','enrollmentstatus.student_no')
                                    ->join('courses','courses.id','enrollmentstatus.course_id')
                                    ->join('sections','sections.id','enrollmentstatus.section_id')
                                    // ->select('students.firstname0');
                                    ->where('academic_year', $request->acad_year);

        if($request->type == 'gender') {
            $students = $students->where('gender', $request->params);
        }
        elseif($request->type == 'year_level') {
            $params = str_replace(['first','second','third','fourth'],['1','2','3','4'], $request->params);
            $students = $students->where('year_level', $params);
        }
        elseif($request->type == 'course') {
            $params =  $request->params;
            // return $params;
            $students = $students->where('program', $params);
        }
        $students = $students->get();
        return view('content.registrar.render.students', compact('students'));
    }
    public function count_enrolled_by_gender($gender, $ac_year) {
        $count = EnrollmentStatus::join('students','students.student_no','enrollmentstatus.student_no')
                                ->select('students.gender','enrollmentstatus.status')
                                ->where([
                                    'gender' => $gender,
                                    'enrollmentstatus.status' => 'enrolled',
                                    'enrollmentstatus.academic_year' => $ac_year
                                    ])
                                ->get()->count();
        return $count;
    }
    public function view_doc(Request $request) {
        $doc_req = Requests::find($request->id);

        return view('content.registrar.render.doc-details', compact('doc_req'))->render();
    }
}
