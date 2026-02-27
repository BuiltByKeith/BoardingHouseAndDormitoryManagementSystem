<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BhTenantBillPayment extends Model
{
    use HasFactory;


    protected $fillable = ['bh_tenant_bill_id', 'amount', 'comment'];

    public function bhTenantBill()
    {
        return $this->belongsTo(TenantBill::class, 'bh_tenant_bill_id', 'id');
    }
}
