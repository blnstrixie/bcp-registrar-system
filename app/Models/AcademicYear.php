<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AcademicTerm;

class AcademicYear extends Model
{
    use HasFactory;

    protected $table = 'academicyears';

    public function academicTerm()
    {
        return $this->belongsTo(AcademicTerm::class, 'academicterm_id');
    }
}
