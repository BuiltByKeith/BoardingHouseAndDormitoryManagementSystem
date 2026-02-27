<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DormitoryRoomTenant extends Model
{
    use HasFactory;

    protected $fillable = ['student_tenant_id', 'dormitory_room_id', 'ay_semester_id', 'isActive', 'clearance_status'];

    public function studentTenant()
    {
        return $this->belongsTo(StudentTenant::class, 'student_tenant_id', 'id');
    }

    public function dormRoom()
    {
        return $this->belongsTo(DormitoryRoom::class, 'dormitory_room_id', 'id');
    }

    public function semester()
    {
        return $this->belongsTo(AySemester::class, 'ay_semester_id', 'id');
    }

    public function dormTenantBills()
    {
        return $this->hasMany(DormTenantBill::class, 'dorm_room_tenant_id');
    }
}
