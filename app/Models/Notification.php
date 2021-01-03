<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'order_id' , 'provider_id' , 'feedback_id','admin_id'
    ];
    
    public function prov()
    {
        return $this->belongsTo('App\Models\Provider','provider_id','id');    
    }
    public function order()
    {
        return $this->belongsTo('App\Models\Order','order_id','id');    
    }

}
