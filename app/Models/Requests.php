<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Documents;
use App\Models\PaymentMethod;
use App\Models\Notifications;

class Requests extends Model
{
    use HasFactory;

    protected $table = 'requests';

    protected $fillable = [
        // Other fillable fields here,
        'studentNum',
        'documentId',
        'paymentmethodId',
        'paymentProof',
        'status',
        'registrar_message',
        'updated_at'
    ];

    public $timestamps = [
        'created_at',
        'updated_at',
    ];

    public function timestamps()
    {
        return true;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'studentNum', 'studentNum');
    }

    public function document()
    {
        return $this->belongsTo(Documents::class, 'documentId', 'id');
    }

    public function paymentmethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'paymentmethodId', 'id');
    }
    
    public function notifications()
    {
        return $this->belongsTo(Notifications::class, 'id', 'request_id');
    }
}
