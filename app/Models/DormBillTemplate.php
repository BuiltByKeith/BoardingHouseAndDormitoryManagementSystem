<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DormBillTemplate extends Model
{
    use HasFactory;

    protected $fillable = ['dormitory_id', 'name'];

    public function dormitory()
    {
        return $this->belongsTo(Dormitory::class, 'dormitory_id');
    }

    public function details()
    {
        return $this->hasMany(DormBillTemplateDetail::class, 'dorm_bill_template_id');
    }
}
