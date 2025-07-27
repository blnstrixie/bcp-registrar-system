<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\YearLevels;
use App\Models\Courses;
use App\Models\Sections;
use App\Models\AcademicYear;
use App\Models\Grades;
use App\Models\Student;
use App\Models\StudentType;
use App\Models\StudentStatus;
use App\Models\Professors;

class EnrollmentStatus extends Model
{
    use HasFactory;

    protected $table = 'enrollmentstatus';
    protected $guarded = [];
    // protected $fillable = [
    //     'student_no',
    //     'yearlevel_id',
    //     'course_id',
    //     'section_id',
    //     'type_id',
    //     'status_id',
    //     'backsubject_id',
    //     'prof_id',
    //     'status',
    // ];

    public $timestamps = true;

    public function student() {
        return $this->belongsTo(Student::class, 'student_no', 'student_no');
    }

    public function yearLevel() {
        return $this->belongsTo(YearLevels::class, 'yearlevel_id');
    }

    public function course() {
        return $this->belongsTo(Courses::class, 'course_id');
    }

    public function section() {
        return $this->belongsTo(Sections::class, 'section_id');
    }

    public function academicYear() {
        return $this->belongsTo(AcademicYear::class, 'yearlevel_id');
    }

    public function grades() {
        return $this->belongsTo(Grades::class, 'student_no', 'student_no');
    }
    public function level() {
        return $this->belongsTo(YearLevels::class, 'year_level');
    }
    public function student_type() {
        return $this->belongsTo(StudentType::class, 'type_id');
    }
    public function student_status() {
        return $this->belongsTo(StudentStatus::class, 'status_id');
    }
    public function adviser() {
        return $this->belongsTo(Professors::class, 'prof_id');
    }
}
