<?php

namespace App\Models;

use App\Notifications\ProviderResetPasswordNotification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Provider extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $guard = "provider";

    protected $fillable = [
        'name','email','password','phone1','phone2','subscribe','visitors','image','cover_image','description'
    ];

    public function Orders(){
        return  $this->hasMany(Order::class);
    }
    public function Msg(){
        return  $this->hasMany(Message::class);
    }
    public function Noti(){
        return $this->belongsTo(Notification::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ProviderResetPasswordNotification($token));
    }
}
