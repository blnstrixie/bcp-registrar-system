<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $table = 'paymentmethod';

    protected $fillable = [
        'payment_method',
        'qr_code',
    ];

    public $timestamps = false;
}
