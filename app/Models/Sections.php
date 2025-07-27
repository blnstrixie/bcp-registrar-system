<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Professors;
use App\Models\YearLevel;

class Sections extends Model
{
    use HasFactory;

    public function adviser()
    {
        return $this->belongsTo(Professors::class, 'prof_id');
    }

    public function yearLevel() {
        return $this->belongsTo(YearLevels::class, 'yearlevel_id');
    }
}
