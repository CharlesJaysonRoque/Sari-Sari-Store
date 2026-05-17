<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlockList extends Model
{
    protected $fillable = [
        'customer_id',
        'violation_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function violation()
    {
        return $this->belongsTo(Violation::class, 'violation_id');
    }

}
