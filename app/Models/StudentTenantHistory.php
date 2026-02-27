<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTenantHistory extends Model
{
    use HasFactory;

    protected $fillable = ['boarding_house_id', 'dormitory_id', 'student_tenant_id', 'comment', 'reason', 'clearance_status'];

    public function boardingHouse()
    {
        return $this->belongsTo(BoardingHouse::class, 'boarding_house_id', 'id');
    }

    public function studentTenant()
    {
        return $this->belongsTo(StudentTenant::class, 'student_tenant_id', 'id');
    }

    public function dormitory()
    {
        return $this->belongsTo(Dormitory::class, 'dormitory_id', 'id');
    }
}
