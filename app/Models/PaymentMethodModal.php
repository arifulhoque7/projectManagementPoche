<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethodModal extends Model
{
    use HasFactory;
    protected $table = 'paymentmethods';
    const UPDATED_AT = null;
    protected $primaryKey = 'id';
}
