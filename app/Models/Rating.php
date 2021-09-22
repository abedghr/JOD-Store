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

    public static function getRating($id) {
        $test = Rating::where('prod_id',$id)->select('rating',Rating::raw('COUNT(rating) as count'))->groupByRaw('rating')->get();
        $star1 = $star2 = $star3 = $star4 = $star5 = 0;
        foreach($test as $rate){
            if($rate->rating == 1){
                $star1 = $rate->count;
            }
            if($rate->rating == 2){
                $star2 = $rate->count;
            }
            if($rate->rating == 3){
                $star3 = $rate->count;
            }
            if($rate->rating == 4){
                $star4 = $rate->count;
            }
            if($rate->rating == 5){
                $star5 = $rate->count;
            }
        }

        $maxR ="";
        if($star1==0 && $star2==0 && $star3==0 && $star4==0 && $star5==0){
            $maxR="3";
        }else{
            $maxR = (5*$star5 + 4*$star4 + 3*$star3 + 2*$star2 + 1*$star1)/($star5 + $star4 + $star3 + $star2 + $star1);
        }

        return $maxR;

    }
}
