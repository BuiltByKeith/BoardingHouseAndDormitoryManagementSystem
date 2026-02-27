<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DormitoryCharge extends Model
{
    use HasFactory;

    protected $fillable = ['dormitory_id', 'name', 'description'];

    public function chargePrices()
    {
        return $this->hasMany(DormChargePrice::class, 'dorm_charge_id');
    }
}
