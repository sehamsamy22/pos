<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $fillable = [
        'ar_name', 'en_name','sub_category_id','price','status','type','description','image','calories','discount','tax'
    ];
    public function subcategory(){
        return $this->belongsTo(SubCategory::class,'sub_category_id');
    }
    public function products(){
        return $this->hasMany(MealProduct::class,'meal_id');
    }
}

