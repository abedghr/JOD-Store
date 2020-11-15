<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'from_provider' , 'from_user' , 'to_provider' , 'to_user' , 'message' , 'is_read'
    ];
}
