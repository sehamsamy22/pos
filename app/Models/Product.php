<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'ar_name', 'en_name','unit','calories','price','image','barcode'
    ];
    public  function orders($id)
    {
        $product_count=0;
        $subscriptions=ClientSubscriptions::where('end', '>=', Carbon::now())->get();
    
       foreach($subscriptions as $subscription){
        foreach($subscription->subscription->meals as $subscriptionmeal) {
            foreach($subscriptionmeal->meal->products as $product){
                if($product->product_id==$id){
                    $product_count+= $product->quantity;
                }
            }
        }
       }
       return $product_count;
    }
}
