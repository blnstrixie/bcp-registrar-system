<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AcademicYear;
use App\Models\Courses;
use App\Models\Sections;
use App\Models\EnrollmentStatus;

class YearLevels extends Model
{
    use HasFactory;

    protected $table = 'yearlevels';

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class, 'id');
    }
    public function course() {
        return $this->belongsTo(Courses::class, 'course_id');
    }

    public function enrollmentStatuses() {
        return $this->hasMany(EnrollmentStatus::class, 'yearlevel_id');
    }

    public function sections() {
        return $this->hasMany(Sections::class, 'yearlevel_id');
    }
}
