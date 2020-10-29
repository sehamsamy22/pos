<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeMeal extends Model
{
    protected $fillable = [
        'name',
    ];
    protected $table='meal_types';
    
    public function meals(){
        return $this->hasMany(Meal::class,'type_id');
    }
}
