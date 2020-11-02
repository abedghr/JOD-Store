<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsOfOrders extends Model
{
    protected $fillable=[
        'prod_name','description','old_price','new_price','quantity','category','provider','main_image','prod_status','order_id'
    ];

    public function order(){
        return $this->belongsTo('App\Models\Order','order_id','id');
    }
    public function provid(){
        return $this->belongsTo('App\Models\Provider','provider','id');
    }
    public function cat(){
        return $this->belongsTo('App\Models\Category','category','id');
    }
}
