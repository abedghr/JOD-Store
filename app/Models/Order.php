<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'fname','lname','email','phone','phone2','city','Address','notes','provider','total_price','total_With_Delivery' ,'order_status','payment_method'
    ];

    
}
