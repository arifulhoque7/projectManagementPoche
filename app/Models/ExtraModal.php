<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraModal extends Model
{
    use HasFactory;   
    protected $table = 'extra';
    const UPDATED_AT = null;
    protected $primaryKey = 'id';
}
