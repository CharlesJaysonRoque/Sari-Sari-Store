<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentTerm extends Model
{
    protected $fillable = [
        'term',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'payment_term_id');
    }
}
