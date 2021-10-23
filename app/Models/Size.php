<?php

namespace App\Models;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = [
        'name','size_price','product_id','barcode','purchase_price','quantity'
    ];
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }


}
