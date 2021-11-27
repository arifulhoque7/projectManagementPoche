<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectModal extends Model
{
    use HasFactory;
    protected $table = 'project';
    const UPDATED_AT = null;
    protected $primaryKey = 'id';
}

