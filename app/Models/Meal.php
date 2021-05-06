<?php

namespace App\Models;

use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $fillable = [
        'ar_name', 'en_name', 'sub_category_id', 'price', 'status', 'type_id', 'description', 'image', 'calories', 'discount', 'tax', 'approx_price', 'barcode', 'unit_id','barcode'
    ];

    public function  lastPrice(){
        $lastMeal=PurchaseItem::where('meal_id',$this->id)->latest()->first();
//        dd($lastProduct->price);
        return $lastMeal->price ?? $this->price;

    }

    public function  quantity(){
       $meal=StoreMeal::where('meal_id',$this->id)->first();
        return $meal->quantity;
    }
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function products()
    {
        return $this->hasMany(MealProduct::class, 'meal_id');
    }
    public function sizes()
    {
        return $this->hasMany(Size::class, 'meal_id');
    }

    public function typeMeal()
    {
        return $this->belongsTo(TypeMeal::class, 'type_id');
    }


}

