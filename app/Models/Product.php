<?php

namespace App\Models;

use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'ar_name', 'en_name','unit','calories','price','image','barcode','sub_category_id','unit_id'
    ];
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
        $productcosts=PurchaseItem::where('product_id',$this->id)->sum('price');
        $productquantits=PurchaseItem::where('product_id',$this->id)->sum('quantity');
//        dd($productquantits);
        return $productcosts /$productquantits;

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
        $from=$request['from'];
        $to=$request['to'];
        //-------------------------array1--------------------------
        $subscriptions_arr=ClientSubscriptions::where('active','1')->get();

        foreach($subscriptions_arr as $subscription){
//            dd($subscriptions_arr);
            $product_count = 0;
            $meals=MealProduct::where('product_id',$id)->pluck('meal_id','id')->toArray();
            $subscription_meal=SubscriptionMeal::where('subscription_id',$subscription->subscription_id)->whereIn('meal_id',$meals)->first();
            if(isset($subscription_meal)) {
                if ($subscription->start <= $from & $to <= $subscription->end) {
                    //   من الى
                    $begin = new DateTime($from);
                    $end = new DateTime($to . ' +1 day');
                    $daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);
                    foreach ($daterange as $date) {
                        $dates[] = $date->format("D");
                    }
                } // بداية نهاية
                elseif ($subscription->start >= $from && $to >= $subscription->end) {
                    $begin = new DateTime($subscription->start);
                    $end = new DateTime($subscription->end . ' +1 day');
                    $daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);
                    foreach ($daterange as $date) {
                        $dates[] = $date->format("D");
                    }
                    // dd( $dates);
                } elseif ($subscription->start <= $from && $to >= $subscription->end) {//من للنهاية
                    $begin = new DateTime($from);
                    $end = new DateTime($subscription->end . ' +1 day');
                    $daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);
                    foreach ($daterange as $date) {
                        $dates[] = $date->format("D");
                    }
                } elseif ($subscription->start >= $from & $to <= $subscription->end) {//بداية الى
                    $begin = new DateTime($subscription->start);
                    $end = new DateTime($to . ' +1 day');
                    $daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);
                    foreach ($daterange as $date) {
                        $dates[] = $date->format("D");
                    }
                }
                $days = array('Sat' => 0, 'Sun' => 0, 'Mon' => 0, 'Tue' => 0, 'Wed' => 0, 'Thu' => 0, 'Fri' => 0);
                foreach ($dates as $date) {
                    if ($date == 'Sat') {
                        $days['Sat'] += 1;
                    } elseif ($date == 'Sun') {
                        $days['Sun'] += 1;
                    } elseif ($date == 'Mon') {
                        $days['Mon'] += 1;
                    } elseif ($date == 'Tue') {
                        $days['Tue'] += 1;
                    } elseif ($date == 'Wed') {
                        $days['Wed'] += 1;
                    } elseif ($date == 'Thu') {
                        $days['Thu'] += 1;
                    } elseif ($date == 'Fri') {
                        $days['Fri'] += 1;
                    }
                }
//-------------------------array2--------------------------

                $all = array('Sat' => 0, 'Sun' => 0, 'Mon' => 0, 'Tue' => 0, 'Wed' => 0, 'Thu' => 0, 'Fri' => 0);
                $saterday_meals = Dietsystem::where('client_subscription_id', $subscription->id)->where('day_No', '1')->pluck('meal_id', 'id')->toArray();
                $sunday_meals = Dietsystem::where('client_subscription_id', $subscription->id)->where('day_No', '2')->pluck('meal_id', 'id')->toArray();
                $monday_meals = Dietsystem::where('client_subscription_id', $subscription->id)->where('day_No', '3')->pluck('meal_id', 'id')->toArray();
                $tusday_meals = Dietsystem::where('client_subscription_id', $subscription->id)->where('day_No', '4')->pluck('meal_id', 'id')->toArray();
                $wensday_meals = Dietsystem::where('client_subscription_id', $subscription->id)->where('day_No', '5')->pluck('meal_id', 'id')->toArray();
                $thurday_meals = Dietsystem::where('client_subscription_id', $subscription->id)->where('day_No', '6')->pluck('meal_id', 'id')->toArray();
                $friday_meals = Dietsystem::where('client_subscription_id', $subscription->id)->where('day_No', '7')->pluck('meal_id', 'id')->toArray();
                $all['Sat'] = $saterday_meals;
                $all['Sun'] = $sunday_meals;
                $all['Mon'] = $monday_meals;
                $all['Tue'] = $tusday_meals;
                $all['Wed'] = $wensday_meals;
                $all['Thu'] = $thurday_meals;
                $all['Fri'] = $friday_meals;
                //-------------------------array3--------------------------

                foreach ($all as $day => $meals) {
                    foreach ($days as $day1 => $dd) {
//dd($days);
                        if ($day == $day1) {
                            foreach ($meals as $meal) {
                                $mealproduct = MealProduct::where('meal_id', $meal)->where('product_id', $id)->first();
//                              dd($mealproduct);
                                if (isset($mealproduct)) {
                                    $dayquantity = $mealproduct->quantity * $dd;
//                                    dd($mealproduct->quantity);
                                    $product_count += $dayquantity;
                                }
                            }

                        }

                    }
                }
            }
//           dd($product_count);
        }

        return $product_count;
    }





}

