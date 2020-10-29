<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $fillable = [
        'ar_name', 'en_name','sub_category_id','price','status','type_id','description','image','calories','discount','tax','approx_price'
    ];
    public function subcategory(){
        return $this->belongsTo(SubCategory::class,'sub_category_id');
    }
    public function products(){
        return $this->hasMany(MealProduct::class,'meal_id');
    }
    public function typeMeal(){
        return $this->belongsTo(TypeMeal::class,'type_id');
    }
}

