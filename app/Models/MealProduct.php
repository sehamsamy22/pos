<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealProduct extends Model
{
    protected $fillable = [
        'meal_id', 'product_id','quantity'
    ];
}
