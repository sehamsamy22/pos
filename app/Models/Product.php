<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'ar_name', 'en_name','unit','calories','price','image','barcode','sub_category_id'
    ];
    public function subcategory(){
        return $this->belongsTo(SubCategory::class,'sub_category_id');
    }
    public  function orders($id,$request)
    {
       $from=$request['from'];
        $to=$request['to'];
        $product_count=0;
        $subscriptions=ClientSubscriptions::whereBetween('start',[$from,$to])
        ->orWhereBetween('end',[$from,$to])
        ->where('active','1')
        ->get();

       foreach($subscriptions as $subscription){
        foreach($subscription->subscription->meals as $subscriptionmeal) {
            foreach($subscriptionmeal->meal->products as $product){
                if($product->product_id==$id){


                    $start=$subscription->start;
                    $end=$subscription->end;
                    $from_start=carbon::parse($from)->diffInDays(carbon::parse($start), false);
                    $to_end=carbon::parse($to)->diffInDays(carbon::parse($end), false);
                     $interval=1;
                     if($from_start >=0 && $to_end <=0){            //    +-
                        $interval=carbon::parse($start)->diffInDays(carbon::parse($end), false);
                    }elseif($from_start >=0 && $to_end >= 0){     //    ++
                        $interval=carbon::parse($start)->diffInDays(carbon::parse($to), false);
                    }elseif($from_start <=0 && $to_end <= 0){     //    --
                        $interval=carbon::parse($from)->diffInDays(carbon::parse($end), false);
                    }elseif($from_start <=0 && $to_end >= 0){     //    +-
                        $interval=carbon::parse($from)->diffInDays(carbon::parse($to), false);
                    }

                    $product_count+= $product->quantity *$interval;
                }
            }
        }


       }




       return $product_count;
    }



}

