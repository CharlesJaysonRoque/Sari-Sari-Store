<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
    protected $fillable = [
        'type',
    ];

    public function blocklist()
    {
        return $this->hasMany(Blocklist::class, 'violation_id');
    }
}
