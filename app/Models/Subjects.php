<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Professors;
use App\Models\YearLevels;
use App\Models\Sections;
use App\Models\Grades;
use App\Models\AcademicTerm;

class Subjects extends Model
{
    use HasFactory;

    protected $table = 'subjects';
    /**
     * Relationship with the EnrollmentStatus model.
     */
    public function professors()
    {
        return $this->belongsTo(Professors::class, 'prof_id');
    }

    // Define the relationship with YearLevels
    public function yearLevel() {
        return $this->belongsTo(YearLevels::class, 'yearlevel_id', 'id');
    }

    // Define the relationship with Sections through YearLevels
    public function section() {
        return $this->belongsTo(Sections::class, 'yearlevel_id', 'yearlevel_id');
    }

    public function grades() {
        return $this->belongsTo(Grades::class, 'id', 'subject_id');
    }
    public function acad_term () {
        return $this->belongsTo(AcademicTerm::class, 'academicterm_id', 'id');
    }
}
