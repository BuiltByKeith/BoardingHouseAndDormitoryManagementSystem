<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BhRoomPrice extends Model
{
    use HasFactory;

    protected $fillable = ['bh_room_id', 'amount', 'isActive', 'date_start', 'date_end'];

    public function room()
    {
        return $this->belongsTo(BoardingHouseRoom::class, 'bh_room_id', 'id');
    }
}
