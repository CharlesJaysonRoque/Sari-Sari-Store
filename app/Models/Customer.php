<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'phone_number',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'customer_id');
    }
    public function blocklist()
    {
        return $this->hasOne(Blocklist::class, 'customer_id');
    }
}
