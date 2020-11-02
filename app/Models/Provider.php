<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Provider extends Authenticatable
{
    use Notifiable;

    protected $guard = "provider";

    protected $fillable = [
        'name','email','password','phone1','phone2','subscribe','visitors','image','cover_image','description'
    ];
}
