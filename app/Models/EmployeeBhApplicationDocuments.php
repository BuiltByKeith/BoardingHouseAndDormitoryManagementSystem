<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeBhApplicationDocuments extends Model
{
    use HasFactory;

    protected $fillable = ['employee_bh_app_id', 'document_name', 'file_path'];

    public function employeeBhApplication()
    {
        return $this->belongsTo(EmployeeBhApplication::class, 'employee_bh_app_app', 'id');
    }
}
