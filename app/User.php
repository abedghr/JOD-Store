<?php

namespace App;

use App\Models\Comment;
use App\Models\Feedback;
use App\Models\Message;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'lname' ,'email', 'password', 'phone', 'phone2','city','Address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function comment(){
        return $this->hasMany(Comment::class);
    }

    public function feedback(){
        return $this->hasMany(Feedback::class);
    }

    public function Msg(){
        return  $this->hasMany(Message::class);
    }
}
