<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class StoreProduct extends Model
{
    protected $fillable = [
         'product_id','quantity'
    ];
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
    public function quantity($product_id,$request){
        $qty=ReceivedProduct::where('product_id',$product_id)->first();
        return $qty->quantity;
    }

}
