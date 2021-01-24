<?php

namespace App\Models;

use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Product extends Model
{
    protected $fillable = [
        'ar_name', 'en_name','unit','calories','price','image','barcode','sub_category_id','unit_id'
    ];
    protected $appends = ['avg_cost'];
    public function subcategory(){
        return $this->belongsTo(SubCategory::class,'sub_category_id');
    }
    public function units(){

        return $this->belongsTo(Unit::class,'unit_id');
    }

    public function  lastPrice(){
        $lastProduct=PurchaseItem::where('product_id',$this->id)->latest()->first();
//        dd($lastProduct->price);
        return $lastProduct->price ?? $this->price;

    }

    public function  avg_cost(){
        $productcosts=PurchaseItem::where('product_id',$this->id)->sum(DB::raw('quantity * price'));
        $productquantits=PurchaseItem::where('product_id',$this->id)->sum('quantity');
//        dd($productquantits);
        if ($productquantits!=0){
            $average=  $productcosts /$productquantits;
        }else{
            $average=0;
        }
        return $average;
    }

    public function   getAvgCostAttribute(){
//        dd("Ygh");
        $productcosts=PurchaseItem::where('product_id',$this->id)->sum(DB::raw('quantity * price'));

        $productquantits=PurchaseItem::where('product_id',$this->id)->sum('quantity');
//        dd($productquantits);
        if ($productquantits!=0){
          $average=  $productcosts /$productquantits;
        }else{
            $average=0;
        }
        return $average;
    }

    public  function recevied($id,$request){

        $qty=ReceivedProduct::where('product_id',$id)->whereBetween('date',[$request['from'],$request['to']])->sum('quantity');

   return $qty;
    }

//    public  function sumation ($id,$request)
//    {
//        $subscriptions_arr=ClientSubscriptions::where('active','1')->get();
//        foreach($subscriptions_arr as $key=>$subscription) {
//        orders($id,$request,$subscription);
//        }
//
//    }



    public  function orders($id,$request)
    {
        $from = $request['from'];
        $to = $request['to'];

        //-------------------------array1--------------------------
        $subscriptions_arr = ClientSubscriptions::where('active', '1')->get();
        $product_count = 0;
        $begin = new DateTime($from);
        $end = new DateTime($to . ' +1 day');
        $daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);
        foreach ($daterange as $date) {
            $dates[] = $date->format("d");
        }

        foreach ($subscriptions_arr as $subscription) {
            $meals_Period = [];
            foreach ($dates as $key => $date) {
                if ($date > 07) {
                    $day = $date % 7;
                    $week = intval(ceil($date / 7));
                } else {
                    $day = intval($date);
                    $week = 1;
                }


                $meals_Day = Dietsystem::where('client_subscription_id', $subscription->id)->where('day_No', $day)->where('week', $week)->pluck('meal_id', 'id')->toArray();

                array_push($meals_Period, $meals_Day);
            }

            foreach ($meals_Period as $key => $meals) {
                foreach ($meals as $meal) {
                    $mealproduct = MealProduct::where('meal_id', $meal)->where('product_id', $this->id)->first();
                    if (isset($mealproduct)) {
                        $product_count += $mealproduct->quantity;
                    }
                }
            }

        }
//dd($product_count);
        return $product_count;
    }
}

