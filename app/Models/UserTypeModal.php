<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTypeModal extends Model
{
    use HasFactory;
    protected $table = 'usertype';
    const UPDATED_AT = null;
    protected $primaryKey = 'id';
}

