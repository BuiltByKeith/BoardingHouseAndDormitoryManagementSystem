<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DormChargePrice extends Model
{
    use HasFactory;
    protected $fillable = ['dorm_charge_id', 'amount', 'isActive', 'date_start', 'date_end'];

    public function dormCharge()
    {
        return $this->belongsTo(DormitoryCharge::class, 'dorm_charge_id');
    }
}
