<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Related extends Model
{
    
    protected $fillable = [
        'name','provider_id'
    ];

    public function product(){
        return $this->hasMany(Product::class);
    }

    public function provider(){
        return $this->belongsTo(Provider::class,'provider_id','id');
    }
}
