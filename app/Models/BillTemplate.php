<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillTemplate extends Model
{
    use HasFactory;

    protected $fillable = ['boarding_house_id', 'name'];

    public function details()
    {
        return $this->hasMany(BillTemplateDetail::class, 'bill_template_id');
    }

    public function boardingHouse()
    {
        return $this->belongsTo(BoardingHouse::class, 'boarding_house_id', 'id');
    }
}
