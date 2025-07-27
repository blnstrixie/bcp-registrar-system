<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subjects;

class Professors extends Model
{
    use HasFactory;

    protected $table = 'professors';

    public function subjects()
    {
        return $this->belongsTo(Subjects::class, 'id', 'prof_id');
    }
}
