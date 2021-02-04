<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = [
        'name','size_price','meal_id'
    ];
    public function meal(){
        return $this->belongsTo(Meal::class,'meal_id');
    }
    public function products()
    {
        return $this->hasMany(MealProduct::class, 'size_id');
    }
}
