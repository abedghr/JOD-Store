<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Category extends Model
{
    use Notifiable;
    
    protected $fillable=[
        'cat_name','cat_image'
    ];

    public function product()
    {
        return $this->hasMany(Product::class);
    }

}
