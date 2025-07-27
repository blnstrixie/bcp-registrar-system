<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\AuditTrail;
use App\Models\Student;
use App\Models\Courses;
use App\Models\Registrar;
use App\Models\Requests;
use App\Models\EnrollmentStatus;
use App\Models\Sections;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Mail;
use App\Mail\Emailer;
use DataTables;
use Session;
use DB;

use \App\Mail\NewUserAccount;

class UserController extends Controller
{
    public function dashboard () {
        $user_role = Auth::user()->role;
        $user = Auth::user();
        if($user_role == 'Admin') {
            return view('dashboard.admin');
        }
        elseif($user_role == 'Registrar') {
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
            return view('dashboard.registrar', compact('user', 'totalStudentCount', 'totalCourseCount', 'totalRequestsCount', 'requests'));;
        }
        elseif($user_role == 'Teacher') {
            return view('dashboard.teacher', compact('user'));
        }
        elseif($user_role == 'Student') {
    $user = Auth::user();
    $student = Student::where('student_no', $user->studentNum)->firstOrFail();
    $enrollmentStatus = EnrollmentStatus::where('student_no', $student->student_no)->first();
    $course = Courses::find($enrollmentStatus->course_id);
    $section = Sections::find($enrollmentStatus->section_id);
    $term = $enrollmentStatus->term;

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
            'documents.document_name',
            'documents.fee',
            'notifications.id as notification_id',
            'notifications.status as notification_status',
            'notifications.updated_at as updated'
        )
        ->where('requests.studentNum', $user->studentNum)
        ->where(function ($query) {
            $query->whereNull('notifications.id')
                  ->orWhereIn('notifications.id', function ($subquery) {
                      $subquery->select(DB::raw('MIN(id)'))
                               ->from('notifications')
                               ->groupBy('request_id');
                  });
        })
        ->get();

    return view('dashboard.student', compact(
        'user',
        'student',
        'course',
        'section',
        'totalNotifications',
        'matchedRequests'
    ));
}
        return redirect()->back();
    }
    public function account_settings() {
        return view('content.account-settings');
    }
    public function update_profile(Request $request) {
        try {

            if($request->hasFile('profile_picture')) {

                // $file_odo = $request->file('odo_meter_photo');
                $pic = $request->file('profile_picture');;
                $profile_name = mt_rand(111111, 999999).date('YmdHms').'.'.$pic->extension();

                if($pic->move('avatars/', $profile_name)) {
                    $avatar = 'avatars/'.$profile_name;
                    User::find($request->user_id)->update(['avatar' => $avatar]);
                }
                return 1;
            }
        }
        catch(\Throwable $th) {
            return response()->json(['message' => $th->getMessage()]);
        }
    }
    public function update_account(Request $request) {
        $user = Auth::user();
        $current_password = $user->password;
        $errors_data = [];

        if(User::where('emailAdd', $request->email)->where('id', '!=', $user->id)->exists()) {
            $errors_data[] = 'Email has been exists.';
        }
        if(User::where('username', $request->username)->where('id', '!=', $user->id)->exists()) {
            $errors_data[] = 'Username has been exists.';
        }
        if($request->password != null && $request->new_password != null) {
            if(!Hash::check($request->password, $user->password)) {
                $errors_data[] = 'Current password is not match.';
            }
            else {
                $current_password = bcrypt($request->new_password);
            }
        }

        if(count($errors_data) > 0) {
            Session::flash('error-message', implode("<br>", $errors_data));
            Session::flash('saved-account','saved');
            return redirect()->back();
        }

        User::find($user->id)->update([
            'username' => $request->username,
            'emailAdd' => $request->email,
            'password' => $current_password,
        ]);

        Session::flash('message', 'Account Saved.');
        Session::flash('saved-account','saved');
        return redirect()->back();
        dd($request->all());
    }
    public function register(){
        return view('auth/signup');
    }
    public function registerPost(Request $request){
        $emailExists = User::where('emailAdd', $request->email)->exists();

        if ($emailExists) {
            return back()->withInput()->withErrors(['email' => 'This email address is already registered']);
        }

        $user = new User();

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->middlename = $request->middlename;
        $user->suffix = $request->suffix;
        $user->studentNum = $request->studentNum;
        $user->emailAdd = $request->email;
        $user->username = $request->username;
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            if ($avatar->isValid()) {
                $avatar->move('avatars', $avatar->getClientOriginalName());
                $user->avatar = 'avatars/' . $avatar->getClientOriginalName();
            } else {
                return back()->with('error', 'Invalid file uploaded.');
            }
        }
        $user->password = Hash::make($request->password);

        $user->save();

        return back()->with('success', 'Register Successfully');
    }

    public function login(){
        return view('auth/login');
    }

    public function loginPost(Request $request){
        $username = $request->username;
        $password = $request->password;

        $user = User::where('username', $username)->first();

        if ($user) {
            if (Hash::check($password, $user->password)) {
                if (Auth::loginUsingId($user->id)) {
                    return redirect('/dashboard')->with('success', 'Login Success.');
                }
            }
        }

        return back()->with('error', 'Invalid username or password. Please retry.');
    }

    public function resetPass(Request $request)
    {
        $user = User::where('emailAdd', $request->input('emailAdd'))->first();

        if (!$user) {
            return redirect('/email-submission')->with('error', 'Email not found. Please enter a valid email.');
        }

        $newPassword = Str::random(10);

        $firstFourDigits = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);

        $remainingPassword = substr($newPassword, 4);

        session(['remainingPassword' => $remainingPassword]);
        session(['email' => $user->emailAdd]);

        $template = 'emails.confirmPasswordReset';

        $mailData = [
            'subject' => 'Password Confirmation',
            'title' => 'Password Reset Confirmation',
            'confirmation_code' => $firstFourDigits,
            'user' => $user->firstname,
            'body' => 'Hello ' . $user->firstname . ',<br><br>We have initiated a password reset for your account. To confirm this action, please enter the first four digits of your new password: ' . $firstFourDigits . '<br><br>If you did not request this change or have any concerns, please contact us immediately.<br><br>Best regards,<br>Your [Your Company] Team',
        ];

        Mail::to($user->emailAdd)->send(new Emailer($mailData, $template));

        $confirmationSentTime = time();
        session(['confirmationSentTime' => $confirmationSentTime]);
        session(['firstFourDigits' => $firstFourDigits]);

        return redirect()->route('send-otp')->with([
            'success' => 'Confirmation code sent to your email.',
            'user' => $user,
        ]);
    }

    public function confirmPassword(Request $request)
    {
        $remainingPassword = session('remainingPassword');
        $confirmationSentTime = session('confirmationSentTime');
        $firstFourDigits = session('firstFourDigits');

        $confirmationCode = implode('', $request->input('confirmation_code')); // Join the array into a string
        $currentTime = time();

        if ($remainingPassword && $confirmationSentTime) {

            if ($confirmationCode === $firstFourDigits && ($currentTime - $confirmationSentTime) <= 60) {
                // Verification successful
                $user = User::where('emailAdd', $request->session()->get('email'))->first();
                $user->password = $remainingPassword;

                $template = 'emails.newPassword';

                $mailData = [
                    'subject' => 'New Password Information',
                    'title' => 'New Password Information',
                    'new_password' => $remainingPassword,
                    'user' => $user->firstname,
                    'body' => 'Hello ' . $user->firstname . ',<br><br>Your password has been successfully reset.<br><br>Your new password is: <strong>' . $remainingPassword . '</strong><br><br>Please log in using this new password and consider changing it to something more memorable once you\'re logged in.<br><br>If you did not initiate this password reset, please contact us immediately.<br><br>Best regards,<br>Your [Your Company] Team',
                ];

                Mail::to($user->emailAdd)->send(new Emailer($mailData, $template));

                $user->save();

                return redirect('login')->with('success', 'Password reset successful. You can now log in with your new password.');
            }
        }

        return redirect()->route('send-otp')->with('error', 'Invalid confirmation code or time limit exceeded. Please try again within 60 seconds.');
    }

    public function logout(){
        Auth::logout();

        return redirect()->route('auth/login');
    }
    public function users_account(Request $request) {
        $sort_role = null;
        $search = null;

        $users = User::whereNot('role','admin');
        if($request->role != NULL) {
            $sort_role = $request->role;
            $users = $users->where('role', $request->role);
        }
        if($request->search != NULL) {
            $search = $request->search;
            $users = $users->where(function ($query) use ($search) {
                $query->where('firstname', 'like', '%' . $search . '%')
                      ->orWhere('lastname', 'like', '%' . $search . '%');
            });
        }

        $users = $users->orderBy('id','desc')->paginate(5);
        return view('content.users.index', compact('users','sort_role','search'));
    }
    public function show($id) {
        try {
            $user = User::find(decrypt($id));
            if($user) {
                return view('content.users.view',compact('user'));
            }
            else {
                Session::flash('error-message', 'No user found.');
                return redirect()->back();
            }
        }
        catch(\Throwable $th) {
            abort(404);
        }
    }
    public function create() {
        return view('content.users.create');
    }
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,emailAdd',
            'role' => 'required',
            'complete_address' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        // If validation passes, you can proceed to save the data.
        $username = substr($request->email, 0, strpos($request->email, '@'));
        $user = User::create([
            'lastname' => $request->last_name,
            'firstname' => $request->first_name,
            'middlename' => $request->middle_name,
            'emailAdd' => $request->email,
            'username' => $username,
            'password' => '123456789', // default
            'role' => $request->role,
            'unique_id' => unique_code(),
            'studentNum' => unique_code(),
            'complete_address' => $request->complete_address,
        ]);

        if($request->role == 'Registrar') {
            $courses = $request->course_access;
            if(count($courses) > 0) {
                foreach($courses as $value) {
                    Registrar::create([
                        'user_id' => $user->id,
                        'courses_access' =>$value, // course id
                    ]);
                }
            }
        }

        $details = [
            'name' => ucwords($request->first_name).' '.ucwords($request->last_name),
            'username' => $username,
            'email' => $request->email,
            'password' => '123456789',
            'role' => $request->role,
        ];
        \Mail::to($request->email)->send(new NewUserAccount($details));

        Session::flash('message', 'User has been added.');
        return redirect()->route('user-management');
    }
    public function delete($id) {
        try {
            $id = decrypt($id);
            $user = User::find($id);
            if($user->delete()) {
                Session::flash('message', 'User has been deleted.');
                return redirect()->back();
            }
        }
        catch (\Throwable $th) {
            Session::flash('error-message', $th->getMessage());
            return redirect()->back();
        }
    }
    public function audit_trails(Request $request) {
        try {
            $user = Auth::user();

            if($request->ajax()) {
                $audit_logs = AuditTrail::select('*');

                if($user->role == 'Teacher') {
                    $audit_logs = $audit_logs->where('user_id', $user->id);
                }

                $audit_logs = $audit_logs->get();
                return DataTables::of($audit_logs)
                ->addIndexColumn()
                ->addColumn('timestamp', function ($row){
                    return $row->created_at;
                })
                ->addColumn('source', function ($row){
                    return $row->source;
                })
                ->addColumn('category', function ($row){
                    return $row->category;
                })
                ->addColumn('action', function ($row){
                    return $row->action;
                })
                ->addColumn('description', function ($row){
                    return $row->description;
                })
                ->rawColumns(['timestamp','source','category','action','description'])
                ->make(true);
            }

            return view('content.audit-trails');
        }
        catch(\Throwable $th) {
            dd($th->getMessage());
        }
    }
}
