<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dietsystem extends Model
{
    protected $fillable = [
         'client_subscription_id','meal_id','day_No','week','size_id'
    ];
    public function meal(){
        return $this->belongsTo(Meal::class,'meal_id');
    }
    public function size(){
        return $this->belongsTo(Size::class,'size_id');
    }
}
