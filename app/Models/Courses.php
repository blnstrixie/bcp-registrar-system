<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\YearLevels;
use App\Models\EnrollmentStatus;

class Courses extends Model
{
    use HasFactory;
    public function enrollmentStatuses() {
        return $this->hasMany(EnrollmentStatus::class, 'course_id');
    }

    public function yearLevels() {
        return $this->hasMany(YearLevels::class, 'course_id');
    }
}
