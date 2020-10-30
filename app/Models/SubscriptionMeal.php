<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionMeal extends Model
{
    protected $fillable = [
         'subscription_id','meal_id'
    ];

  protected $table ='subscriptions_meals';

    public function subscription(){
        return $this->belongsTo(Subscription::class,'subscription_id');
    }

}
