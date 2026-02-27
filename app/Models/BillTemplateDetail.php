<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillTemplateDetail extends Model
{
    use HasFactory;

    protected $fillable = ['bill_template_id', 'charge_id'];

    public function template()
    {
        return $this->belongsTo(BillTemplate::class, 'bill_template_id', 'id');
    }

    public function charge()
    {
        return $this->belongsTo(BoardingHouseCharge::class, 'charge_id', 'id');
    }
}
