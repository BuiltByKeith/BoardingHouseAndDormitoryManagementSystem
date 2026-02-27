<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DormTenantBill extends Model
{
    use HasFactory;

    protected $fillable = ['dorm_room_tenant_id', 'dorm_bill_template_id', 'month', 'payment_status'];

    public function dormRoomTenant()
    {
        return $this->belongsTo(DormitoryRoomTenant::class, 'dorm_room_tenant_id', 'id');
    }

    public function dormBillTemplate()
    {
        return $this->belongsTo(DormBillTemplate::class, 'dorm_bill_template_id', 'id');
    }

    public function dormTenantBillPayments()
    {
        return $this->hasMany(DormTenantBillPayment::class, 'dorm_tenant_bill_id');
    }
}
