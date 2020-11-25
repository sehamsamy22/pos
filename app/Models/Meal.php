<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $fillable = [
        'ar_name', 'en_name','sub_category_id','price','status','type_id','description','image','calories','discount','tax','approx_price'
    ];
    public function subcategory(){
        return $this->belongsTo(SubCategory::class,'sub_category_id');
    }
    public function products(){
        return $this->hasMany(MealProduct::class,'meal_id');
    }
    public function typeMeal(){
        return $this->belongsTo(TypeMeal::class,'type_id');
    }


    public  function orders($id,$request)
    {
        $from=$request['from'];
        $to=$request['to'];
        $meal_count=1;
        $subscriptions=ClientSubscriptions::whereBetween('start',[$from,$to])
                    ->orWhereBetween('end',[$from,$to])
                    ->where('active','1')
                    ->get();

       foreach($subscriptions as $subscription){
        foreach($subscription->subscription->meals as $subscriptionmeal) {
            if($subscriptionmeal->meal_id==$id){

                  $start=$subscription->start;
                    $end=$subscription->end;
                    $from_start=carbon::parse($from)->diffInDays(carbon::parse($start), false);
                    $to_end=carbon::parse($to)->diffInDays(carbon::parse($end), false);
                     $interval=1;
                     if($from_start >=0 && $to_end <=0){            //    +-
                         $interval=carbon::parse($start)->diffInDays(carbon::parse($end), false);
                     }elseif($from_start >=0 && $to_end >= 0){     //    ++
                         $interval=carbon::parse($start)->diffInDays(carbon::parse($to), false);
                     }elseif($from_start <=0 && $to_end <= 0){     //    --
                         $interval=carbon::parse($from)->diffInDays(carbon::parse($end), false);
                     }elseif($from_start <=0 && $to_end >= 0){     //    +-
                         $interval=carbon::parse($from)->diffInDays(carbon::parse($to), false);
                     }

                 $meal_count+= $meal_count * $interval;


            }
        }
       }

       return $meal_count;
    }

    public function quantity($meal_id,$request){

        $qty=ReadyMeal::where('meal_id',$meal_id)->whereBetween('date',[$request['from'],$request['to']])->first();

        return $qty->quantity?? '0';
    }
}

