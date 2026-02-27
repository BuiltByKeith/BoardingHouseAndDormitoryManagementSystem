<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AySemester extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'acad_year_id'];

    public function acadYear()
    {
        return $this->belongsTo(AcadYear::class, 'acad_year_id', 'id');
    }
}
