<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductLog extends Model
{
    protected $fillable = [
        'product_id', 'operation','bill_id','quantity'
    ];
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

    public function purchase(){
        return $this->belongsTo(Purchase::class,'bill_id');
    }
    public function sale(){
        return $this->belongsTo(Sale::class,'bill_id');
    }
}

