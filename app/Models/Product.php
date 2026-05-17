<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function stockins()
    {
        return $this->hasMany(Stocks::class, 'product_id');
    }
    public function stockouts()
    {
        return $this->hasMany(StockOut::class, 'product_id');
    }
    public function stocks()
    {
        return $this->hasMany(Stocks::class, 'product_id');
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'product_id');
    }
}
