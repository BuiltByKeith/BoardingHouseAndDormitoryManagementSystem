<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardingHouseRoomTenants extends Model
{
    use HasFactory;

    protected $fillable = ['student_tenant_id', 'boarding_house_room_id', 'ay_semester_id', 'isActive', 'clearance_status'];

    public function studentTenant()
    {
        return $this->belongsTo(StudentTenant::class, 'student_tenant_id', 'id');
    }
    public function boardingHouseRoom()
    {
        return $this->belongsTo(BoardingHouseRoom::class, 'boarding_house_room_id', 'id');
    }

    public function semester()
    {
        return $this->belongsTo(AySemester::class, 'ay_semester_id', 'id');
    }

    public function bills()
    {
        return $this->hasMany(TenantBill::class, 'bh_room_tenant_id');
    }
}
