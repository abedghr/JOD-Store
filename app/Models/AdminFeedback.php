<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminFeedback extends Model
{
    protected $fillable =[
        'name','email','phone','feedback'
    ];
}
