<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dietsystem extends Model
{
    protected $fillable = [
         'client_subscription_id','meal_id','day_No'
    ];

    public function meal(){
        return $this->belongsTo(Meal::class,'meal_id');
    }
}
