<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminOfProvider extends Model
{
    protected $guard = 'provider';

    protected $fillable = [
        'name','email','password'
    ];
}
