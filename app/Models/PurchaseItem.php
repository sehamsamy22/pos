<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    protected $fillable = [
        'purchase_id', 'meal_id','quantity','discount','tax','total_price','price'
    ];

    public function purchase(){
        return $this->belongsTo(Purchase::class,'purchase_id');
    }
    public function meal(){
        return $this->belongsTo(Meal::class,'meal_id');
    }

}

