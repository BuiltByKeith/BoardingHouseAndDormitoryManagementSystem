<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantBill extends Model
{
    use HasFactory;
    protected $fillable = ['bh_room_tenant_id', 'bill_template_id', 'month', 'payment_status'];


    public function bhRoomTenant()
    {
        return $this->belongsTo(BoardingHouseRoomTenants::class, 'bh_room_tenant_id', 'id');
    }

    public function template()
    {
        return $this->belongsTo(BillTemplate::class, 'bill_template_id', 'id');
    }

    public function bhTenantBillPayments()
    {
        return $this->hasMany(BhTenantBillPayment::class, 'bh_tenant_bill_id');
    }
}
