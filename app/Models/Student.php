<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\EnrollmentStatus;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_no',
        'firstname',
        'lastname',
        'middlename',
        'suffix',
    ];

    /**
     * Relationship with the User model.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'student_no', 'studentNum');
    }
    /**
     * Relationship with the EnrollmentStatus model.
     */
    public function enrollmentStatus()
    {
        return $this->hasOne(EnrollmentStatus::class, 'student_no', 'student_no');
    }
}
