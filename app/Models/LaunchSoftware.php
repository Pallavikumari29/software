<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaunchSoftware extends Model
{
    use HasFactory;
    protected $table="launch_software";
    protected $fillable=[
        'name',
        'phone_number',
        'email',
        'price',
        'discount',
        'feature',
    ];
}
