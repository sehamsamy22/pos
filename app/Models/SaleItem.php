<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    protected $fillable = [
        'sale_id', 'meal_id','quantity','discount','total_price'
    ];
    public function sale(){
        return $this->belongsTo(Sale::class,'sale_id');
    }
    public function meal(){
        return $this->belongsTo(Meal::class,'meal_id');
    }
}

