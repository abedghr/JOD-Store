<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'feedback','user_id','provider_id'
    ];

    public function theusers(){
      return  $this->belongsTo('App\User','user_id','id');
    }
}
