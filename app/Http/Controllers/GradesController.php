<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuditTrail;
use App\Models\Grades;
use App\Models\Student;
use App\Models\Subjects;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail;
use Excel;
use DB;
use DataTables;
use Session;
use App\Imports\ImportGrades;

class GradesController extends Controller
{
    public function index(Request $request) {
        try{
            if($request->ajax()) {
                $latestGrades = Grades::select('id','student_no', 'subject_id')->groupBy(['id','student_no', 'subject_id'])
                                    ->latest('created_at')
                                    ->get();

                                    $latestGrades = Grades::whereIn('id', function($query) {
                                        $query->select(DB::raw('MAX(id)'))
                                            ->from('grades')
                                            ->groupBy(['student_no', 'subject_id']);
                                    })->get();
                // $grades = Grades::select('*')->groupBy(['student_no', 'subject_id'])->get();
                // $grades = Grades::groupBy('student_no', 'subject_id')->select('student_no', 'subject_id','prelim', \DB::raw('MAX(id) as max_id'))
                // ->latest('max_id')->get();
                return DataTables::of($latestGrades)
                ->addIndexColumn()
                ->addColumn('stud_no', function ($row){
                    return $row->student_no;
                })
                ->addColumn('stud_name', function ($row){
                    $student_no = $row->student_no;
                    $student = Student::where('student_no', $student_no)->first();
                    $student_name = '';
                    if($student) {
                        $student_name = ucwords($student->lastname).', '.ucwords($student->firstname).' '.ucwords($student->middlename);
                    }
                    return $student_name;
                })
                ->addColumn('section', function ($row){
                    $student_section = DB::table('enrollmentstatus')
                                         ->join('sections','enrollmentstatus.section_id','sections.id')
                                         ->where('enrollmentstatus.student_no', $row->student_no)
                                         ->select('sections.*')
                                         ->latest('sections.id')->first();
                    return $student_section->section_name ?? 'Undefined';
                })
                ->addColumn('subject_code', function ($row){
                    $subj_code = $row->subjects->subject_code ?? 'Undefined';
                    return $subj_code;
                })
                ->addColumn('desc_title', function ($row){
                    $subj_desc = $row->subjects->descriptive_title ?? 'Undefined';
                    return $subj_desc;
                })
                ->addColumn('prelim', function ($row){
                    return $row->prelim_grade;
                })
                ->addColumn('midterm', function ($row){
                    return $row->midterm_grade;
                })
                ->addColumn('final', function ($row){
                    return $row->final_grade;
                })
                ->addColumn('remarks', function ($row){
                    return $row->remarks;
                })
                ->addColumn('prof', function ($row){
                    $prof = DB::table('subjects')
                              ->join('professors','professors.id','subjects.prof_id')
                              ->where('subjects.id',$row->subject_id)
                              ->select('professors.*')->first();
                    return $prof->full_name ?? '';
                })
                ->rawColumns(['stud_no','stud_name','section','subject_code','desc_title','prelim','midterm','final','remarks','prof'])
                ->make(true);
            }
            return view('grades.index');
        }
        catch(\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function fetch_student(Request $request) {
        $student = Student::where('student_no', $request->student_no)->first();
        return $student;
    }
    public function fetch_grade(Request $request) {
        $prelim = 0.00;
        $midterm = 0.00;
        $final = 0.00;
        $remarks = '';
        $acad_year = now()->format('Y');

        $grades = Grades::where(['student_no' => $request->s_no, 'subject_id' => $request->subj_id])
                        ->orderBy('id','desc')
                        ->first();

        if($grades) {
            $prelim = $grades->prelim_grade;
            $midterm = $grades->midterm_grade;
            $final = $grades->final_grade;
            $acad_year = $grades->acad_year;
            $remarks = $grades->remarks;
        }
        $data = [
            'prelim' => $midterm,
            'midterm' => $prelim,
            'final' => $final,
            'remarks' => $remarks,
            'acad_year' => $acad_year
        ];
        return $data;
    }
    public function store_grade(Request $request) {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $subject = Subjects::find($request->subject_id)->first();
            $term = $subject->term;
            $grade_exists = Grades::where(['student_no' => $request->student_number, 'subject_id' => $request->subject_id])->exists();

            Grades::create([
                'student_no' => $request->student_number,
                'subject_id' => $request->subject_id,
                'prelim_grade' => $request->prelim_grade,
                'midterm_grade' => $request->midterm_grade,
                'final_grade' => $request->final_grade,
                'term' => $request->acad_term,
                'acad_year' => $request->acad_year,
                'remarks' => $request->remarks,
                'added_by' => Auth::user()->id,
                'created_at' => now()->format('Y-m-d H:i:s'),
                'updated_at' => now()->format('Y-m-d H:i:s'),
            ]);

            $log_type = $grade_exists == true ? 'edited' : 'added';
            AuditTrail::create([
                'source'        =>  'manual',
                'category'      =>  'grades',
                'action'        =>  $log_type,'description'   =>  'Student No.: ' .$request->student_number .'<br />'
                                    . ' Subject Code: ' . $subject->subject_code .' | '
                                    . ' Prelim: ' . $request->prelim_grade .' | '.' Midterm: ' .' | '. $request->midterm_grade .' | '.' Final: '. $request->final_grade .' | '.' Year: '. $request->acad_year.' | '.' Remarks: '. $request->remarks,
                'user_id'       =>  Auth::user()->id,
            ]);

            DB::commit();
            Session::flash('message', 'Grade has been added.');
            return redirect()->back();
        }
        catch(\Throwable $th) {
            DB::rollback();
            Session::flash('error-message', $th->getMessage());
            return redirect()->back();
        }
    }
    public function grades_import_view() {
        return view('grades.import');
        return view('admin.grades.import-excel');
    }

    public function download_grade_excel_template() {
        return response()->download(public_path('assets/excel-templates/template-excel-bcp-grades.xlsx'));
    }
    public function import_grades(Request $request) {
        try {
            $this->validate($request, [
                'grades_file' => 'required'
            ]);
            Excel::import(new ImportGrades, $request->grades_file);

            return redirect()->back()->with(['message' => 'Grades Imported Successfully!', 'alert-bg' => 'bg-success']);
        }
        catch(\Throwable $th) {
            return redirect()->back()->with(['message' => $th->getMessage(), 'alert-bg' => 'bg-danger']);
        }
    }
    public function get_students_number(Request $request) {
        $year_level_id = $request->year_level;
        $course_id = $request->course_id;
        $term = $request->acad_term;

        $data = DB::table('enrollmentstatus')
                  ->join('students','students.student_no','enrollmentstatus.student_no')
                  ->where([
                    'enrollmentstatus.status' => 'Enrolled',
                    'enrollmentstatus.yearlevel_id' => $year_level_id,
                    'enrollmentstatus.course_id' => $course_id,
                    'enrollmentstatus.term' => $term
                  ])->select('enrollmentstatus.*','students.firstname','students.lastname','students.middlename')->get();

        return $data;
        // return response()->json(['data' => $]);
    }
    public function get_student_subjects(Request $request) {
        $level = $request->year_level;
        $course_id = $request->course_id;
        $term = $request->acad_term;

        $year_level_id = DB::table('yearlevels')->where('level', $level)->where('course_id', $course_id)->first()->id;

        $subjects = DB::table('subjects')->where('yearlevel_id', $year_level_id)->where('academicterm_id', $term)->get();
        return $subjects;
    }
}
