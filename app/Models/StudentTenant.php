<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTenant extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'firstname', 'middlename', 'lastname', 'extname', 'sex', 'program_id', 'permanent_address', 'contact_no', 'guardian_id'];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id', 'id');
    }

    public function studentTenantHistory()
    {
        return $this->hasMany(StudentTenantHistory::class, 'student_tenant_id');
    }

    public function guardian()
    {
        return $this->belongsTo(StudentTenantGuardian::class, 'guardian_id', 'id');
    }

    public function clearances()
    {
        return $this->hasMany(StudentClearance::class, 'student_tenant_id');
    }
}
