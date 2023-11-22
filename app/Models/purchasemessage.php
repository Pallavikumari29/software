<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class purchasemessage extends Model
{
    use HasFactory;

    protected $table="purchase_message";

    protected $fillable=[
        'user_id',
        'message_id',
        'amount',
        'status',
    ];
}
