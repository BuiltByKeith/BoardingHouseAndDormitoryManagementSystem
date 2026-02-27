<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DormitoryImage extends Model
{
    use HasFactory;

    protected $fillable = ['dormitory_id', 'file_name', 'file_path'];

    public function dormitory()
    {
        return $this->belongsTo(Dormitory::class, 'dormitory_id', 'id');
    }
}
