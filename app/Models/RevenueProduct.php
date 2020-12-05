<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RevenueProduct extends Model
{
    protected $fillable = [
        'product_id','revenue_id','quantity'
    ];
    protected  $table='revenue_products';
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

    public function revenue(){
        return $this->belongsTo(Revenue::class,'revenue_id');
    }

}

