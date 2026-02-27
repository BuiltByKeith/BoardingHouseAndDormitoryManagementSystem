<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DormTenantBillPayment extends Model
{
    use HasFactory;


    protected $fillable = ['dorm_tenant_bill_id', 'amount', 'comment'];

    public function dormTenantBill()
    {
        return $this->belongsTo(DormTenantBill::class, 'dorm_tenant_bill_id', 'id');
    }
}
