<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Requests;

class Notifications extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $guarded =[];

    protected $casts = [
        'status' => 'boolean',
    ];

    public $timestamps = [
        'created_at',
        'updated_at',
    ];

    public function requests()
    {
        return $this->belongsTo(Requests::class, 'id', 'request_id');
    }
}
