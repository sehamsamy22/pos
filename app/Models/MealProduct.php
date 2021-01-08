<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealProduct extends Model
{
    protected $fillable = [
        'meal_id', 'product_id','quantity','avg_cost'
    ];
    public function meal(){
        return $this->belongsTo(Meal::class,'meal_id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
