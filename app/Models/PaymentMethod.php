<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = [
        'method',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'payment_method_id');
    }
}
