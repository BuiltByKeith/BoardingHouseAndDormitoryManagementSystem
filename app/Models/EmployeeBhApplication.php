<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeBhApplication extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'boarding_house_name', 'sex_accepted', 'lodging_type', 'complete_address', 'longitude', 'latitude', 'status', 'comment'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    public function documents()
    {
        return $this->hasMany(EmployeeBhApplicationDocuments::class, 'employee_bh_app_id');
    }
}
