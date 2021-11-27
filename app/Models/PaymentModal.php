<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentModal extends Model
{
    use HasFactory;   
    protected $table = 'payments';
    const UPDATED_AT = null;
    protected $primaryKey = 'id';
}
