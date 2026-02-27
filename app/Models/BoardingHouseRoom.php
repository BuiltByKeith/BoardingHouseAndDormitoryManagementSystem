<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardingHouseRoom extends Model
{
    use HasFactory;

    protected $fillable = ['room_name', 'number_of_beds', 'boarding_house_id'];

    public function boardingHouse()
    {
        return $this->belongsTo(BoardingHouse::class, 'boarding_house_id', 'id');
    }

    public function roomStudentTenants()
    {
        return $this->hasMany(BoardingHouseRoomTenants::class, 'boarding_house_room_id');
    }

    public function roomPrices()
    {
        return $this->hasMany(BhRoomPrice::class, 'bh_room_id');
    }
}
