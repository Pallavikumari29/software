<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table="message";
    protected $fillable=[
        'user_id',
        'content',
        'amount',
        'slug',
        'expiry',
        'no_of_sales',
        'file',
        'status',
        'title',
    ];
}
