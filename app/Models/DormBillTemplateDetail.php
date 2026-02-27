<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DormBillTemplateDetail extends Model
{
    use HasFactory;

    protected $fillable = ['dorm_bill_template_id', 'dorm_charge_id'];

    public function dormTemplate()
    {
        return $this->belongsTo(DormBillTemplate::class, 'dorm_bill_template_id', 'id');
    }

    public function dormCharge()
    {
        return $this->belongsTo(DormitoryCharge::class, 'dorm_charge_id', 'id');
    }
}
