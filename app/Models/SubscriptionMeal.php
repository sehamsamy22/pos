<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionMeal extends Model
{
    protected $fillable = [
         'subscription_id','meal_id','day','week'
    ];
  protected $table ='subscriptions_meals';
    public function subscription(){
        return $this->belongsTo(Subscription::class,'subscription_id');
    }
    public function meal(){
        return $this->belongsTo(Meal::class,'meal_id');
    }

}
