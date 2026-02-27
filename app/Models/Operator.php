<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'boarding_house_id'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    public function boardingHouse()
    {
        return $this->belongsTo(BoardingHouse::class,'boarding_house_id', 'id');
    }
}
