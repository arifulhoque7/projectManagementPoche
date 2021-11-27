<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhaseDetailsModal extends Model
{
    use HasFactory;   
    protected $table = 'phasedetails';
    const UPDATED_AT = null;
    protected $primaryKey = 'id';
}
