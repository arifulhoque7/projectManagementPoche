<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventModal extends Model
{
    use HasFactory;
    protected $table = 'event';
    const UPDATED_AT = null;
    protected $primaryKey = 'id';
}
