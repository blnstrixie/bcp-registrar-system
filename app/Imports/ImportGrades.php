<?php

namespace App\Imports;

use App\Models\Grades;
use App\Models\AuditTrail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Illuminate\Support\Facades\DB;
use Auth;

class ImportGrades implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // if()
        $subject_code = $row['subject_code'];

        $subject = DB::table('subjects')->where('subject_code', $subject_code)->first();
        $user_id = Auth::user()->id;


        AuditTrail::create([
            'source'        =>  'import',
            'category'      =>  'grades',
            'action'        =>  'add/import',
            'description'   =>  'Student No.: ' .$row['student_no'] .'<br />'
                                . ' Subject Code: ' . $row['subject_code'] .' | '
                                . ' Prelim: ' . $row['prelim_grade'] .' | '.' Midterm: ' .' | '. $row['midterm_grade'] .' | '.' Final: '. $row['final_grade'] .' | '.' Year: '. $row['academic_year'].' | '.' Remarks: '. $row['remarks'],
            'user_id'       =>  $user_id,
        ]);

        $term = $subject->academicterm_id;
        $subject_id = $subject->id ?? 0;

        // Insert current row to grades table
        return new Grades([
            'student_no' => $row['student_no'],
            'subject_id' => $subject_id,
            'prelim_grade' => $row['prelim_grade'],
            'midterm_grade' => $row['midterm_grade'],
            'final_grade' => $row['final_grade'],
            'term'          => $term,
            'acad_year' => $row['academic_year'],
            'remarks' => $row['remarks'],
            'added_by' => $user_id,
            'created_at' => now()->format('Y-m-d H:i:s'),
            'updated_at' => now()->format('Y-m-d H:i:s'),
        ]);

        // if($grade) {
        //     // if inserted, insert to audit_trails table
        // }
    }
}
