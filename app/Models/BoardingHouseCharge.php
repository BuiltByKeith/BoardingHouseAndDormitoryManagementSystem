<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardingHouseCharge extends Model
{
    use HasFactory;

    protected $fillable = ['boarding_house_id', 'name', 'description'];

    public function prices()
    {
        return $this->hasMany(BhChargePrice::class, 'bh_charge_id');
    }

    public function boardingHouse()
    {
        return $this->belongsTo(BoardingHouse::class, 'boarding_house_id', 'id');
    }
}
