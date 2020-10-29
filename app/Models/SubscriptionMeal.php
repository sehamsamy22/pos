<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionMeal extends Model
{
    protected $fillable = [
         'subscription_id','type_id'
    ];

  protected $table ='subscriptions_type_meals';

    public function subscription(){
        return $this->belongsTo(Subscription::class,'subscription_id');
    }
    public function typeMeal(){
        return $this->belongsTo(TypeMeal::class,'type_id');
    }
}
