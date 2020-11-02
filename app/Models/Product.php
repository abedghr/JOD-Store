<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use Notifiable;
    

    protected $fillable=[
        'prod_name','description','old_price','new_price','category','gender','provider','main_image','availability','prod_status','country_made','prod_related'
    ];

    public function cat()
    {
        return $this->belongsTo('App\Models\Category','category','id');
    }
    public function related()
    {
        return $this->belongsTo('App\Models\Related','prod_related','id');
    }

    public function prov()
    {
        return $this->belongsTo('App\Models\Provider','provider','id');    
    }
    
}
