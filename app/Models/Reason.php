<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    protected $fillable = [
        'title',
    ];

    public function stockouts()
    {
        return $this->hasMany(StockOut::class, 'reason_id');
    }
}
