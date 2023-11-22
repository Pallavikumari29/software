<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageDiscount extends Model
{
    use HasFactory;

    protected $table="message_discount";

    protected $fillable=[
        'message_id',
        'voucher_code',
        'voucher_discount_percentage',
        'expiry',
        'is_private',
       
    ];
}
