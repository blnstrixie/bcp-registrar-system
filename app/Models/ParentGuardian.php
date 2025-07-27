<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentGuardian extends Model
{
    use HasFactory;
    
    protected $table = 'parentguardian';

    protected $fillable = [
        'student_no',
    ];

    public $timestamps = false;
}
