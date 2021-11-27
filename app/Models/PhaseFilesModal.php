<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhaseFilesModal extends Model
{
    use HasFactory;
    protected $table = 'phasefiles';
    const UPDATED_AT = null;
    protected $primaryKey = 'id';
}
