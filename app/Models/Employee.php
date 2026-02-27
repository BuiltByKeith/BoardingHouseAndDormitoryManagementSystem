<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'firstname', 'middlename', 'lastname', 'extname', 'sex', 'contact_no'];

    public function user()
    {
        return $this->hasOne(User::class, 'employee_id');
    }

    public function operator()
    {
        return $this->hasOne(Operator::class, 'employee_id');
    }
    public function dormManager()
    {
        return $this->hasOne(DormManager::class, 'employee_id');
    }
    public function assocPersonnel()
    {
        return $this->hasOne(AssocPersonnel::class, 'employee_id');
    }
    public function osaPersonnel()
    {
        return $this->hasOne(OsaPersonnel::class, 'employee_id');
    }

}
