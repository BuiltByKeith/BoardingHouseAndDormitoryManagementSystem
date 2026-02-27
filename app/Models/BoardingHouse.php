<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardingHouse extends Model
{
    use HasFactory;

    protected $fillable = ['boarding_house_name', 'lodging_type', 'sex_accepted', 'longitude', 'latitude', 'classification'];

    public function boardingHouseRooms()
    {
        return $this->hasMany(BoardingHouseRoom::class, 'boarding_house_id');
    }

    public function operator()
    {
        return $this->hasOne(Operator::class, 'boarding_house_id');
    }

    public function bhDocuments()
    {
        return $this->hasMany(BoardingHouseDocument::class, 'boarding_house_id');
    }

    public function bhPhotos()
    {
        return $this->hasMany(BoardingHouseImage::class, 'boarding_house_id');
    }
}
