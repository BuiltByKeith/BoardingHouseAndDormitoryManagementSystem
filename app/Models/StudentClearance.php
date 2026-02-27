<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClearance extends Model
{
    use HasFactory;

    protected $fillable = ['student_tenant_id', 'clearance_status', 'ay_semester_id'];

    public function studentTenant()
    {
        return $this->belongsTo(StudentTenant::class, 'student_tenant_id', 'id');
    }

    public function semester()
    {
        return $this->belongsTo(AySemester::class, 'ay_semester_id', 'id');
    }
}
