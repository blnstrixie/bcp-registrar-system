<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Courses;
use App\Models\EnrollmentStatus;
use App\Models\Professors;
use App\Models\Sections;
use App\Models\Subjects;
use App\Models\Timetable;
use App\Models\YearLevels;

use Auth;
use DB;
use Session;

class CoursesController extends Controller
{
    public function index() {
        $user = Auth::user();
        $course = Courses::withCount('enrollmentStatuses')
                    ->with(['yearLevels' => function ($query) {
                        $query->withCount('enrollmentStatuses');
                    }])
                    ->get();
        $courses = Courses::pluck('program');
        $yearLevels = YearLevels::distinct()->pluck('year_levels');

        return view('content.courses.index', compact('user', 'course', 'courses', 'yearLevels'));
    }
    public function save_course(Request $request) {
        $course = new Courses();
        $course->code = $request->code;
        $course->program = $request->program;
        $course->description = $request->description;
        $course->college = $request->college;
        $course->major = $request->major;
        $course->credit_hours = $request->credit_hours;
        $course->no_term = $request->no_term;

        if($course->save()) {
            $lvls = [
                ['id' => '1', 'level' => '1st Year'],
                ['id' => '2', 'level' => '2nd Year'],
                ['id' => '3', 'level' => '3rd Year'],
                ['id' => '4', 'level' => '4th Year'],
            ];
            foreach($lvls as $item) {
                DB::table('yearlevels')->insert([
                    'level' => $item['id'],
                    'year_levels' => $item['level'],
                    'course_id' => $course->id
                ]);
            }
            Session::flash('message', 'New course has been added.');
        }
        else {
            Session::flash('error-message', 'Something went wrong.');
        }

        return back();
    }
    public function save_subject(Request $request) {
        $subject = new Subjects();
        $subject->subject_code = $request->code;
        $subject->descriptive_title = $request->title;
        $subject->units = $request->units;
        $subject->prof_id = $request->professor;
        $subject->academicterm_id = $request->term;
        $subject->yearlevel_id = $request->yearlevel_id;

        if($subject->save()) {
            Session::flash('message', 'New subject has been added.');
        }
        else {
            Session::flash('error-message', 'Something went wrong.');
        }

        return back();
    }
    public function course_info($code) {
        $user = Auth::user();
        $course = Courses::where('code',$code)->first();

        $enrolledCount = EnrollmentStatus::where('course_id', $course->id)
                        ->where('status', 'Enrolled')
                        ->count();

        return view('content.courses.info', compact('user', 'course', 'enrolledCount'));
    }
    public function course_year_level($code, $year) {
        if(!Courses::where('code' , $code)->exists()) {
            abort(404);
        }
        $course_subjects = Subjects::join('professors','professors.id','subjects.prof_id')
                                    ->join('yearlevels','yearlevels.id','subjects.yearlevel_id')
                                    ->join('courses','courses.id','yearlevels.course_id')
                                    ->where(['yearlevels.level' => $year, 'courses.code' => $code])
                                    ->select('subjects.*','professors.full_name')
                                    ->orderBy('subjects.academicterm_id','asc')
                                    ->get();


        $course_sections = Sections::join('professors','professors.id','sections.prof_id')
                                    ->join('yearlevels','yearlevels.id','sections.yearlevel_id')
                                    ->join('courses','courses.id','sections.course_id')
                                    ->where(['yearlevels.level' => $year, 'courses.code' => $code])
                                    ->select('sections.*', 'professors.full_name')
                                    ->get();

        $user = Auth::user();
        $course = Courses::where('code' , $code)->first();

        $sections = Sections::join('professors','professors.id','sections.prof_id')->where('course_id', $course->id)
                            ->where('sections.yearlevel_id', $year)
                            ->select('sections.*', 'professors.full_name')
                            ->get();

        $professors = [];
        $subjects = [];

        if($sections->isNotEmpty()) {
            $sectionIds = $sections->pluck('yearlevel_id')->toArray();
            $subjects = Subjects::whereIn('yearlevel_id', $sectionIds)->get();

            $professors = Professors::whereIn('id', $subjects->pluck('prof_id'))->get();
        }
        // $subs = Subjects;
        // dd()
        return view('content.courses.info-year-level', compact('course_subjects','course_sections','user', 'course', 'sections', 'professors', 'subjects', 'year'));
    }
    public function timetable($code, $year) {

        $user = Auth::user();
        $course = Courses::where('code' , $code)->first();
        $year = $year;
        $timetable = Timetable::with('subjects', 'sections')
                        ->whereHas('subjects', function($query) use ($year) {
                            $query->where('yearlevel_id', $year);
                        })->get();

        return view('content.courses.timetable', compact('user', 'course', 'timetable', 'year'));
    }
    public function print_sections($code, $year) {

        // $course_id = DB::table('courses')->where('code', $code)->first()->id;
        $course = DB::table('courses')->where('code', $code)->first();

        if(!$course) {
            abort(404);
        }

        $sections = Sections::join('professors','professors.id','sections.prof_id')
                                    ->join('yearlevels','yearlevels.id','sections.yearlevel_id')
                                    ->join('courses','courses.id','sections.course_id')
                                    ->where(['yearlevels.level' => $year, 'courses.code' => $code])
                                    ->select('sections.*', 'professors.full_name')
                                    ->get();

        $course = DB::table('courses')->where('code', $code)->first();
        // dd($sections);
        return view('prints.sections',compact('sections','course'));
    }
    public function more_details($code , $year, $section) {

        $course = DB::table('courses')->where('code', $code)->first();
        $section = DB::table('sections')->where('section_name', $section)->first();
        if(!$course) {
            abort(404);
        }
        return view('content.courses.view-details', compact('course','section','year'));
    }
}
