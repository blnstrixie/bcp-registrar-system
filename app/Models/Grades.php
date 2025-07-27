<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subjects;

class Grades extends Model
{
    use HasFactory;

    protected $table = 'grades';

    // protected $fillable = [
    //     'student_no',
    //     'subject_id',
    //     'prelim_grade',
    //     'midterm_grade',
    //     'final_grade',
    //     'gwa',
    // ];
    protected $guarded = [];

    public $timestamps = false;

    public function subjects() {
        return $this->belongsTo(Subjects::class, 'subject_id', 'id');
    }
}
