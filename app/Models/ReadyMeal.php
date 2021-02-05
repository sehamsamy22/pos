<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReadyMeal extends Model
{
    protected $fillable = [
        'date', 'meal_id','quantity','received','distributed','received_quantity','distributed_quantity','size_id'
    ];

    public function meal(){
        return $this->belongsTo(Meal::class,'meal_id');
    }
    public function size(){
        return $this->belongsTo(Size::class,'size_id');
    }
}
