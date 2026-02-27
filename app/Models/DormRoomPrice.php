<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DormRoomPrice extends Model
{
    use HasFactory;
    protected $fillable = ['dorm_room_id', 'amount', 'isActive', 'date_start', 'date_end'];

    public function dormRoom()
    {
        return $this->belongsTo(DormitoryRoom::class, 'dorm_room_id', 'id');
    }
}
