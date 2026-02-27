<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DormManager extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'dormitory_id'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    public function dormitory()
    {
        return $this->belongsTo(Dormitory::class,'dormitory_id', 'id');
    }
}
