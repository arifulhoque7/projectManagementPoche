<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyModal extends Model
{
    use HasFactory;    
    protected $table = 'company';
    const UPDATED_AT = null;
    protected $primaryKey = 'id';
}


