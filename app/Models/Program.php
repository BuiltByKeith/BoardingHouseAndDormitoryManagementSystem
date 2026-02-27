<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = ['program_name', 'college_id'];

    public function college()
    {
        return $this->belongsTo(College::class, 'college_id', 'id');
    }
}
