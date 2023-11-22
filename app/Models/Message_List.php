<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message_List extends Model
{
    use HasFactory;
    protected $table='message_lists';
    protected $fillable=[
        'user_id',
        'date',
        'amount',
        'mode_of_payment',
        'transaction_id',
    ];
}
