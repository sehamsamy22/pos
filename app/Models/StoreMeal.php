<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class StoreMeal extends Model
{
    protected $fillable = [
         'meal_id','quantity'
    ];
    public function meal(){
        return $this->belongsTo(Meal::class,'meal_id');
    }


}
