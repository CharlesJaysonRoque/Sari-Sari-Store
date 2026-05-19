<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stocks extends Model
{
    protected $fillable = [
        'product_id',
        'stock_quantity',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function stockIn()
{
    return $this->hasOne(
        \App\Models\StockIn::class,
        'product_id',
        'product_id'
    )->whereColumn('stock_ins.version', 'stocks.version');
}
}
