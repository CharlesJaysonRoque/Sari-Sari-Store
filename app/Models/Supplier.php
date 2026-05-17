<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'street',
        'city',
        'zip_code',
        'phone_number',
    ];

    public function stockins()
    {
        return $this->hasMany(StockIn::class, 'supplier_id');
    }
}
