<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhaseDetailsFilesModal extends Model
{
    use HasFactory;
    protected $table = 'phasedetailsfiles';
    const UPDATED_AT = null;
    protected $primaryKey = 'id';
}
