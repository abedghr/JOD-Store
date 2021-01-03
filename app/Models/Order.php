<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'fname','lname','email','phone','phone2','city','Address','notes','provider','total_price','total_With_Delivery' ,'order_status','payment_method'
    ];

    public function Prov(){
        return $this->belongsTo('App\Models\Provider','provider','id');
    }
    public function Notify(){
        return $this->belongsTo(Notification::class);
    }
}
