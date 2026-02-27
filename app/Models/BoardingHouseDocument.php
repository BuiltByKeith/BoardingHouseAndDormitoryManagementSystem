<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardingHouseDocument extends Model
{
    use HasFactory;

    protected $fillable = ['boarding_house_id', 'document_name', 'file_name', 'file_path'];

    public function boardingHouse()
    {
        return $this->belongsTo(BoardingHouse::class, 'boarding_house_id', 'id');
    }
}
