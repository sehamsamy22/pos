<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReadyMeal extends Model
{
    protected $fillable = [
        'date', 'meal_id','quantity','received','distributed','received_quantity','distributed_quantity'
    ];
 
    public function meal(){
        return $this->belongsTo(Meal::class,'meal_id');
    }
}
