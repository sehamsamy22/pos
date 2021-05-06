<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryMeal extends Model
{
    protected $fillable = [
        'inventory_id','meal_id','quantity','real_quantity'
    ];
    public function meal()
    {
        return $this->belongsTo(Meal::class, 'meal_id');
    }
}
