<?php

namespace App\Models;

use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Database\Eloquent\Model;
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
        $productcosts=PurchaseItem::where('product_id',$this->id)->sum('price');
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
        $productcosts=PurchaseItem::where('product_id',$this->id)->sum('price');
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

    function quantity($meals,$product_count,$rep){

        foreach ($meals as $key=>$meal) {
            $mealproduct = MealProduct::where('meal_id', $meal)->where('product_id',$this->id)->first();
            if (isset($mealproduct)) {
                $product_count+= $mealproduct->quantity;
            }
        }

        return $product_count;
    }

    public  function orders($id,$request)
    {
        $from=$request['from'];
        $to=$request['to'];
        //-------------------------array1--------------------------
        $subscriptions_arr=ClientSubscriptions::where('active','1')->get();
        $product_count = 0;
        $product_count_all=0;
        $product_count_sat=0; $product_count_sun=0; $product_count_mon=0;$product_count_tue =0;$product_count_wed=0;$product_count_thu=0; $product_count_fri=0;
        foreach($subscriptions_arr as $d=> $subscription){

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
                    $diffdays=\Carbon\Carbon::parse( $from )->diffInDays( $to );
                } // بداية نهاية
                elseif ($subscription->start >= $from && $to >= $subscription->end) {
                    $begin = new DateTime($subscription->start);
                    $end = new DateTime($subscription->end . ' +1 day');
                    $daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);
                    foreach ($daterange as $date) {
                        $dates[] = $date->format("D");
                    }
                    $diffdays=\Carbon\Carbon::parse( $from )->diffInDays( $to );

                    // dd( $dates);
                } elseif ($subscription->start <= $from && $to >= $subscription->end) {//من للنهاية
                    $begin = new DateTime($from);
                    $end = new DateTime($subscription->end . ' +1 day');
                    $daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);
                    foreach ($daterange as $date) {
                        $dates[] = $date->format("D");
                    }
                    $diffdays=\Carbon\Carbon::parse( $from )->diffInDays( $to );

                } elseif ($subscription->start >= $from & $to <= $subscription->end) {//بداية الى
                    $begin = new DateTime($subscription->start);
                    $end = new DateTime($to . ' +1 day');
                    $daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);
                    foreach ($daterange as $date) {
                        $dates[] = $date->format("D");
                    }
                    $diffdays=\Carbon\Carbon::parse( $from )->diffInDays( $to );

                }
                $days = array('Sat' => 0, 'Sun' => 0, 'Mon' => 0, 'Tue' => 0, 'Wed' => 0, 'Thu' => 0, 'Fri' => 0);
                foreach ($dates as $date) {
                    if ($date == 'Sat') {
                        $days['Sat'] = 1;
                    } elseif ($date == 'Sun') {
                        $days['Sun'] = 1;
                    } elseif ($date == 'Mon') {
                        $days['Mon'] = 1;
                    } elseif ($date == 'Tue') {
                        $days['Tue']= 1;
                    } elseif ($date == 'Wed') {
                        $days['Wed'] = 1;
                    } elseif ($date == 'Thu') {
                        $days['Thu'] = 1;
                    } elseif ($date == 'Fri') {
                        $days['Fri'] = 1;
                    }
                }

              //---------------------validation_days--------------

//-------------------------array2--------------------------

                $all = array('Sat' => 0, 'Sun' => 0, 'Mon' => 0, 'Tue' => 0, 'Wed' => 0, 'Thu' => 0, 'Fri' => 0);
                $saterday_meals = Dietsystem::where('client_subscription_id', $subscription->id)->where('day_No', '1')->pluck('meal_id', 'id')->toArray();
                $sunday_meals = Dietsystem::where('client_subscription_id', $subscription->id)->where('day_No', '2')->pluck('meal_id', 'id')->toArray();
                $monday_meals = Dietsystem::where('client_subscription_id', $subscription->id)->where('day_No', '3')-> pluck('meal_id', 'id')->toArray();
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
//dd($days);
                foreach ($all as $day => $meals) {

                        if ($day== 'Sat') {
                            $product_count_sat+=$this->quantity($meals,$product_count,$days['Sat'])*$days['Sat'];
                       }else if ($day== 'Sun') {
                            $product_count_sun+=$this->quantity($meals,$product_count,$days['Sun']) *$days['Sun'];

                        }else if ($day== 'Mon') {
                            $product_count_mon +=$this->quantity($meals,$product_count,$days['Mon'])*$days['Mon'];
                        }else if ($day== 'Tue') {
                        $product_count_tue+=$this->quantity($meals,$product_count,$days['Tue'] )*$days['Tue'];
                        }
                        else if ($day== 'Wed') {
                            $product_count_wed+=$this->quantity($meals,$product_count,$days['Wed'])*$days['Wed'] ;
                        }else if ($day== 'Thu') {
                            $product_count_thu+=$this->quantity($meals,$product_count,$days['Thu'])*$days['Thu'] ;

                        }else if ($day== 'Fri') {
                            $product_count_fri+=$this->quantity($meals,$product_count,$days['Fri'])*$days['Fri'];

                        }
                }
//                $product_count_all+=$product_count;

            }
            $total=$product_count_sat+$product_count_sun+$product_count_mon+$product_count_tue+$product_count_wed+$product_count_thu+$product_count_fri;
        }

//

            if ($diffdays > 7){

                session(['key' => 1]);
                alert()->warning('الفتره اكبر من 7ايام !')->autoclose(5000);
            }else{
                session(['key' => 0]);
            }

        return $total;
    }





}

