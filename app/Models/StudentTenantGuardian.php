<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentTenantGuardian extends Model
{
    use HasFactory;

    protected $fillable = ['firstname', 'middlename', 'lastname', 'extname', 'birthdate', 'sex', 'contact_no', 'occupation'];

}
