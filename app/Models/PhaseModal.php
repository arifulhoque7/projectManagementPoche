<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhaseModal extends Model
{
    use HasFactory;   
    protected $table = 'phase';
    const UPDATED_AT = null;
    protected $primaryKey = 'id';
}
