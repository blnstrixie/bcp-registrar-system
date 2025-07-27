<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deficiencies extends Model
{
    use HasFactory;

    protected $table = 'deficiencies';

    protected $fillable = [
        // Other fillable fields here,
        'student_no',
        'document',
        'deadline'
    ];

    public $timestamps = false;
}
