<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminModal extends Model
{
    use HasFactory;
    protected $table = 'admin';
    const UPDATED_AT = null;
    protected $primaryKey = 'id';
}
