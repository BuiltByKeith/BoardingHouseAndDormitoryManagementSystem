<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DormitoryRoom extends Model
{
    use HasFactory;

    protected $fillable = ['room_name', 'room_price', 'number_of_beds', 'dormitory_id'];

    public function dormitory()
    {
        return $this->belongsTo(Dormitory::class, 'dormitory_id', 'id');
    }

    public function dormRoomStudentTenants()
    {
        return $this->hasMany(DormitoryRoomTenant::class, 'dormitory_room_id');
    }

    public function roomPrices()
    {
        return $this->hasMany(DormRoomPrice::class, 'dorm_room_id');
    }
}
