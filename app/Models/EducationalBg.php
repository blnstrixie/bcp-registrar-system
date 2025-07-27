<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalBg extends Model
{
    use HasFactory;

    protected $table = 'educationalbg';

    protected $fillable = [
        'student_no',
    ];

    public $timestamps = false;
}
