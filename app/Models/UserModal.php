<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModal extends Model
{ 
    use HasFactory;
    protected $table = 'user';
    const UPDATED_AT = null;
    protected $primaryKey = 'id';
}
