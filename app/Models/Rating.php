<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'rating','user_id','prod_id'
    ];

    public function product(){
        return $this->belongsTo('App\Models\Product','prod_id','id');
    }
}
