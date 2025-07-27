<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subjects;
use App\Models\Sections;

class Timetable extends Model
{
    use HasFactory;

    protected $table = 'timetable';

    public function subjects()
    {
        return $this->belongsTo(Subjects::class, 'subject_id', 'id');
    }

    public function sections()
    {
        return $this->belongsTo(Sections::class, 'section_id', 'id');
    }
}
