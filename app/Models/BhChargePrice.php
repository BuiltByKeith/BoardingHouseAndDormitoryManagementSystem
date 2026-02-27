<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BhChargePrice extends Model
{
    use HasFactory;

    protected $fillable = ['bh_charge_id', 'amount', 'isActive', 'date_start', 'date_end'];

    public function bhCharge()
    {
        return $this->belongsTo(BoardingHouseCharge::class, 'bh_charge_id', 'id');
    }
}
