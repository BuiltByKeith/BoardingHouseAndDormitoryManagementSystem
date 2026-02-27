<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $fillable = ['psgcCode', 'provDesc', 'regCode', 'provCode'];

    public function region()
    {
        return $this->belongsTo(Region::class, 'regCode', 'regCode');
    }
}
