<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dormitory extends Model
{
    use HasFactory;

    protected $fillable = ['dormitory_name', 'sex_accepted', 'longitude', 'latitude'];

    public function dormitoryRooms()
    {
        return $this->hasMany(DormitoryRoom::class, 'dormitory_id');
    }
    public function dormManager()
    {
        return $this->hasOne(DormManager::class, 'dormitory_id');
    }

    public function dormPhotos()
    {
        return $this->hasMany(DormitoryImage::class, 'dormitory_id');
    }
}
