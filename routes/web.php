<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\GradesController;
use App\Http\Controllers\RegistrarController;
use App\Http\Controllers\MailControl;

Route::get('/app', function () {
    return view('app');
});
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('user.dashboard');
    }
    return redirect()->route('auth.login');
    return view('auth.login');
})->name('index');


Route::group(['middleware' => 'guest'], function(){
    Route::get('/login', [AuthController::class, 'show_login'])->name('auth.login');
    // Route::post('post-login', [AuthController::class, 'show_login'])->name('auth.login');
    Route::post('/attempt-login', [AuthController::class, 'attempt_login'])->name('attempt.login');
    Route::post('/login', [
        UserController::class, 'loginPost'
    ])->name('auth-login');

    Route::get('/signup', [
        UserController::class, 'register'
    ])->name('auth/signup');

    Route::post('/signup', [
        UserController::class, 'registerPost'
    ])->name('auth/signup');

    Route::get('/email-submission', function () {
        return view('auth/email-submission');
    })->name('email-submission');

    Route::post('/send-otp', [
        UserController::class, 'resetPass'
    ])->name('send-otp');

    Route::get('/send-otp', function () {
        return view('auth/otp');
    })->name('send-otp');

    Route::post('/confirm-password', [
        UserController::class, 'confirmPassword'
    ])->name('confirm-password');
});

Route::group(['middleware' => 'student'], function(){
    Route::get('student/dashboard', [
        StudentController::class, 'index'
    ])->name('student/dashboard');

    Route::get('/profile', [
        StudentController::class, 'profile'
    ])->name('student/profile');

    Route::get('/documents-hub', [
        StudentController::class, 'documentsHub'
    ])->name('student/documents-hub');

    Route::get('doc-get-message',[StudentController::class, 'doc_get_message'])->name('doc.get.message');

    Route::post('/createReq', [
        StudentController::class, 'requests'
    ])->name('requests');

    Route::get('getdetails/{id}', [
        StudentController::class, 'viewDetails'
    ])->name('getdetails');

    Route::post('/prof/{id}', [
        StudentController::class, 'prof'
    ])->name('prof');

    Route::post('/acc/{id}', [
        StudentController::class, 'acc'
    ])->name('acc');

    Route::get('/settings', [
        StudentController::class, 'settings'
    ])->name('student/settings');

});

Route::group(['middleware' => 'registrar'], function(){
    Route::get('registrar/dashboard', [
        RegistrarController::class, 'index'
    ])->name('registrar/dashboard');

    Route::get('registrar/students', [
        RegistrarController::class, 'regstud'
    ])->name('registrar/students');

    Route::get('registrar/courses', [
        RegistrarController::class, 'courses'
    ])->name('registrar/courses');

    Route::get('registrar/grades', [
        RegistrarController::class, 'grades'
    ])->name('registrar/grades');

    // Route::get('audit-trail', [
    //     RegistrarController::class, 'audittrail'
    // ])->name('audit-trail');

    Route::get('registrar/report', [
        RegistrarController::class, 'report'
    ])->name('registrar/report');

    Route::get('registrar/students-list-course', [
        RegistrarController::class, 'studentslistpercourse'
    ])->name('registrar/students-list-course');

    Route::get('registrar/students-list-yearlevel', [
        RegistrarController::class, 'studentslistperyearlevel'
    ])->name('registrar/students-list-yearlevel');

    Route::get('registrar/students-list-gender', [
        RegistrarController::class, 'studentslistpergender'
    ])->name('registrar/students-list-gender');

    Route::get('registrar/grade-report', [
        RegistrarController::class, 'gradereport'
    ])->name('registrar/grade-report');

    Route::get('registrar/accounts', [
        RegistrarController::class, 'accounts'
    ])->name('registrar/accounts');

    Route::get('/get-student-info/{studentNum}', [
        RegistrarController::class, 'getStudentInfo'
    ])->name('get-student-info');

    Route::get('per-year/{id}/{year}', [
        RegistrarController::class, 'perYear'
    ])->name('perYear');

    Route::get('prints/students-list', [
        RegistrarController::class, 'print'
    ])->name('prints/students-list');

    Route::get('prints/report', [
        RegistrarController::class, 'printRep'
    ])->name('prints/report');

    Route::get('prints/overall-gradereport', [
        RegistrarController::class, 'printoverallgradereport'
    ])->name('prints/overall-gradereport');

    Route::get('prints/percourse-gradereport', [
        RegistrarController::class, 'printpercoursegradereport'
    ])->name('prints/percourse-gradereport');

    Route::get('prints/peryearlevel-gradereport', [
        RegistrarController::class, 'printperyearlevelgradereport'
    ])->name('prints/peryearlevel-gradereport');

    Route::get('printTor/{studentNum}', [
        RegistrarController::class, 'printTor'
    ])->name('printTor');

    Route::get('printsSheet/{studentNum}/{year}', [
        RegistrarController::class, 'gradeSheet'
    ])->name('printsSheet');

    Route::get('printCor/{studentNum}', [
        RegistrarController::class, 'printCor'
    ])->name('printCor');

    Route::get('registrar/timetable/{id}/{year}', [
        RegistrarController::class, 'timetable'
    ])->name('registrar/timetable');

    Route::get('registrar/settings', [
        RegistrarController::class, 'settings'
    ])->name('registrar/settings');

    Route::post('/payment_method', [
        RegistrarController::class, 'method'
    ])->name('method');

    Route::post('/create_documents', [
        RegistrarController::class, 'documents'
    ])->name('documents');

    Route::post('/create', [
        RegistrarController::class, 'store'
    ])->name('store');

    Route::post('/createStud', [
        RegistrarController::class, 'storeStud'
    ])->name('storeStud');

    Route::post('/updateProf/{id}', [
        RegistrarController::class, 'profile'
    ])->name('profile');

    Route::post('/update-grade/{id}', [
        RegistrarController::class, 'update'
    ])->name('update-grade');

    Route::post('/updateAcc/{id}', [
        RegistrarController::class, 'account'
    ])->name('account');

    Route::post('/destroyReg/{id}', [
        RegistrarController::class, 'destroy'
    ])->name('destroyReg');

    Route::post('/deleteDocs/{id}', [
        RegistrarController::class, 'destroyDocs'
    ])->name('deleteDocs');

    Route::post('/deleteMethod/{id}', [
        RegistrarController::class, 'destroyMethod'
    ])->name('destroyMethod');

    Route::post('/deleteStud/{id}', [
        RegistrarController::class, 'destroyStud'
    ])->name('destroyStud');

    Route::post('/acceptStud/{id}', [
        RegistrarController::class, 'accept'
    ])->name('accept');

    Route::post('/rejectStud/{id}', [
        RegistrarController::class, 'reject'
    ])->name('reject');

    Route::get('/registrar/student-profile/{studentNum}', [
        RegistrarController::class, 'viewStudentProfile'
    ])->name('registrar/student-profile');

    Route::get('/studentList', [
        RegistrarController::class, 'studList'
    ])->name('studentList');

    Route::get('/reportList', [
        RegistrarController::class, 'reportPrint'
    ])->name('reportList');

    Route::get('paymentProof/{id}', [
        RegistrarController::class, 'paymentProof'
    ])->name('paymentProof');

    Route::post('updatePending/{id}', [
        RegistrarController::class, 'Pending'
    ])->name('updatePending');

    Route::post('updateProcess/{id}', [
        RegistrarController::class, 'Process'
    ])->name('updateProcess');

    Route::delete('destroyDef/{id}', [
        RegistrarController::class, 'destroyDef'
    ])->name('destroyDef');

    Route::post('/createDef', [
        RegistrarController::class, 'storeDef'
    ])->name('storeDef');

    Route::get('get-details/{id}', [
        RegistrarController::class, 'viewDetails'
    ])->name('get-details');

    Route::get('registrar/{id}', [
        RegistrarController::class, 'courseInfo'
    ])->name('courseInfo');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::redirect('/home', '/dashboard');

//ADMIN
Route::get('admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('admin/registrar-users', function () {
    return view('admin.registrar-users');
})->name('admin.registrar-users');

Route::get('admin/teacher-users', function () {
    return view('admin.teacher-users');
})->name('admin.teacher-users');

Route::get('admin/student-users', function () {
    return view('admin.student-users');
})->name('admin.student-users');

Route::get('admin/settings', function () {
    return view('admin.settings');
})->name('admin.settings');

//TEACHER
Route::get('teacher/dashboard', function () {
    return view('teacher.dashboard');
})->name('teacher.dashboard');

Route::get('teacher/upload-grades', function () {
    return view('teacher.upload-grades');
})->name('teacher.upload-grades');

Route::get('teacher/settings', function () {
    return view('teacher.settings');
})->name('teacher.settings');



Route::get('/grades-file-template',[GradesController::class,'download_grade_excel_template'])->name('grades-excel-template');
Route::middleware(['auth','prevent-back-history'])->group(function () {
    // USER DASHBOARD | HOME PAGE
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

    // Grades Routes
    Route::get('grades',  [GradesController::class,'index'])->name('grades-list');
    Route::get('fetch-student',[GradesController::class,'fetch_student'])->name('grades.fetch-student');
    Route::get('fetch-grade',[GradesController::class,'fetch_grade'])->name('grades.fetch-grade');
    Route::post('insert-grade', [GradesController::class,'store_grade'])->name('grades.store');
    // Route::get()->name();

    // GRADE IMPORT EXCEL
    Route::get('/grades-file-import',[GradesController::class,'grades_import_view'])->name('grades-import-view');
    Route::post('/grades-import',[GradesController::class,'import_grades'])->name('grades-import');



    // USER MANAGEMENT
    Route::get('users-account', [UserController::class, 'users_account'])->name('user-management');
    Route::get('users-account/create', [UserController::class, 'create'])->name('user-management.create');
    Route::post('users-account/store', [UserController::class, 'store'])->name('user-management.store');
    Route::get('users-account/{id}/show', [UserController::class, 'show'])->name('user-management.show');
    Route::get('users-account/delete/{id}' ,[UserController::class, 'delete'])->name('user-management.delete');

    // AUDIT TRAILS (ACTIVITY LOGS)
    Route::get('audit-trail', [UserController::class, 'audit_trails'])->name('audit-trail');

    Route::get('unique-code', function () {
        // return unique_code();
        return now()->format('Ymd').DB::table('users')->max('id') + 1;
    });

    // DOCUMENTS (TOR)
    Route::get('documents-list', [RegistrarController::class, 'documents_page'])->name('documents');
    Route::get('fetch-students', [RegistrarController::class, 'fetch_students'])->name('documents.fetch-students');
    Route::get('transcript-of-records/{id}', [RegistrarController::class, 'show_tor'])->name('documents.show-tor');

    // STUDENTS LIST
    Route::get('students', [StudentController::class, 'students_page'])->name('students.page');
    Route::get('students-list', [StudentController::class, 'students_list'])->name('students.list');
    Route::get('students/profile/{id}', [StudentController::class, 'student_view_profile'])->name('students.view-profile')->middleware(['registrar']);
    Route::get('view-student-request', [StudentController::class, 'student_view_profile_request'])->name('students.view-profile.requests')->middleware(['registrar']);
    Route::get('get-sections', [StudentController::class, 'get_sections'])->name('student.get-section');
    Route::post('save-enrollment', [StudentController::class, 'save_enrollment'])->name('student.save-enrollment');
    Route::post('marked-as-graduated', [StudentController::class, 'marked_graduated'])->name('student.marked-graduated');

    // COURSES
    Route::group(['middleware' => 'registrar'], function(){
        Route::get('courses', [CoursesController::class, 'index'])->name('courses');
        Route::post('save-course', [CoursesController::class, 'save_course'])->name('courses.store');
        Route::post('save-subject', [CoursesController::class, 'save_subject'])->name('subjects.store');
        Route::get('courses/{code}', [CoursesController::class, 'course_info'])->name('courses.info');
        Route::get('courses/{code}/year-level-{year}', [CoursesController::class, 'course_year_level'])->name('courses.info.year-level');
        Route::get('courses/{code}/year-level-{year}/print-page', [CoursesController::class, 'print_sections'])->name('print.sections');
        Route::get('courses/{code}/year-level-{year}/timetable', [CoursesController::class, 'timetable'])->name('courses.info.year-level.timetable');
        Route::get('courses/{code}/year-level-{year}/{section}-details', [CoursesController::class, 'more_details'])->name('courses.info.year-level.details');
        // Route::get('courses/year-level-{id}/', [CoursesController::class, 'course_info'])->name('courses.info');

        Route::get('fetch-sections', [RegistrarController::class, 'fetch_section'])->name('fetch-section');
    });

    // REPORTS
    Route::get('enrollment-reports', [RegistrarController::class, 'enrollment_reports'])->name('reports.enrollment')->middleware(['registrar']);
    Route::get('enrollment-reports/academic-year-{year}', [RegistrarController::class, 'enrollment_reports_print'])->name('reports.enrollment.print')->middleware(['registrar']);

    Route::get('enrollment-show-students', [RegistrarController::class, 'enrollment_reports_show_students'])->name('enrollment_reports.show-students');

    Route::get('count-gender',  [StudentController::class, 'count_gender']);

    Route::get('update-grades-data', function () {
        $grades = DB::table('grades')->get();
        foreach($grades as $grade) {
            $term = DB::table('subjects')->where('id', $grade->subject_id)->first()->academicterm_id;

            // DB::table('grades')->where('id', $grade->id)->update([
            //     'term' => $term
            // ]);
            echo $term .'<br>';
        }
    });

    // ACCOUNT SETTINGS
    Route::get('account-settings',[UserController::class, 'account_settings'])->name('account.settings');
    Route::post('account-settings/update-profile', [UserController::class, 'update_profile'])->name('account.update-profile');
    Route::post('account-settings/update-account', [UserController::class, 'update_account'])->name('account.update-account');

    Route::get('view-doc', [RegistrarController::class, 'view_doc'])->name('request.view-doc');

    // NOTIFICATIONS
    Route::get('count-notification', [StudentController::class, 'count_notif'])->name('notification.count');
    Route::get('view-notification', [StudentController::class, 'show_notif'])->name('notification.view');


    Route::get('get-students-no', [GradesController::class, 'get_students_number'])->name('get.students-no');
    Route::get('get-student-subjects', [GradesController::class, 'get_student_subjects'])->name('get.student-subject');
});
