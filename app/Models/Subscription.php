<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'name', 'description','price','duration','num_meals','discount'
    ];
    public function meals(){
        return $this->hasMany(SubscriptionMeal::class,'subscription_id');
    }
    public  function meals_week_edit($week,$i,$type){
        $meals=SubscriptionMeal::where('subscription_id',$this->id)->where('week',$week)->where('day',$i)->get();
        return $meals;
    }
}
