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


    public  function orders($id)
    {
        $meal_count=0;
        $subscriptions=ClientSubscriptions::where('end', '>=', Carbon::now()->tomorrow())->get();
    
       foreach($subscriptions as $subscription){
        foreach($subscription->subscription->meals as $subscriptionmeal) {
            if($subscriptionmeal->meal_id==$id){
                $meal_count+= 1;
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

