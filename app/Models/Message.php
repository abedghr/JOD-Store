<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'from_provider' , 'from_user' , 'to_provider' , 'to_user' , 'message' , 'is_read'
    ];

    public function fromUser(){
        return  $this->belongsTo('App\User','from_user','id');
    }
    public function toUser(){
        return  $this->belongsTo('App\User','to_user','id');
    }
    public function fromProvider()
    {
        return $this->belongsTo('App\Models\Provider','from_provider','id');    
    }
    public function toProvider()
    {
        return $this->belongsTo('App\Models\Provider','to_provider','id');    
    }
}
