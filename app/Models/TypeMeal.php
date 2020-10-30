<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeMeal extends Model
{
    protected $fillable = [

        'name',
    ];
    protected $table='meal_types';

    public function meals(){
        return $this->hasMany(Meal::class,'type_id');
    }

    public function meals_sub($id){
        $mealsub=SubscriptionMeal::where('subscription_id',$id)->pluck('meal_id','id')->toArray();
        $meals=Meal::where('type_id',$this->id)->whereIn('id',$mealsub)->get();
        return $meals;
    }
}
