<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Software_Sale extends Model
{
    use HasFactory;
    protected $table = "software_sale";
    protected $fillable = [
        'software_id',
        'date',
        'amount',
        'customer_name',
        'customer_number',
        'customer_email',
        'trans_id',
        'order_id',
        'status',

    ];
}
