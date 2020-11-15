<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AdminsOfProvider extends Authenticatable
{
    use Notifiable;
    
    protected $guard = 'admin_provider';

    protected $fillable = [
        'name','email','password','provider'
    ];

    public function MainProvider(){
        return $this->belongsTo('App\Models\Provider','provider','id');
    }
}
