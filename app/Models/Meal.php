<?php

namespace App\Models;

use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $fillable = [
        'ar_name', 'en_name', 'sub_category_id', 'price', 'status', 'type_id', 'description', 'image', 'calories', 'discount', 'tax', 'approx_price', 'barcode', 'unit_id'
    ];

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function products()
    {
        return $this->hasMany(MealProduct::class, 'meal_id');
    }
    public function sizes()
    {
        return $this->hasMany(Size::class, 'meal_id');
    }

    public function typeMeal()
    {
        return $this->belongsTo(TypeMeal::class, 'type_id');
    }

    public function readymeals($id, $request)
    {
        $qty = ReadyMeal::where('meal_id', $id)->whereBetween('date', [$request['from'], $request['to']])->sum('quantity');
        return $qty;
    }

//    function quantity_meal($meals, $meal_count, $ferq)
//    {
//
//        foreach ($meals as $meal) {
//            if ($meal == $this->id) {
//                $meal_count++;
//            }
//        }
//
//        return $meal_count;
//    }

public  function existInSystem($sub,$week,$day,$type){
        $exist=Dietsystem::where('client_subscription_id',$sub)->where('meal_id',$this->id)->where('day_No',$day)->where('week',$week)->first();
       return $exist;
}

   public function orders($id, $request)
    {

        $from =  $request['from'];
        $to = $request['to'];
        //-------------------------array1--------------------------
        $subscriptions_arr = ClientSubscriptions::where('active', '1')->get();
        $meal_count = 0;
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

                $meals_Day = Dietsystem::where('client_subscription_id', $subscription->id)->where('day_No', $day)->where('week', $week)->pluck('size_id', 'id')->toArray();
                array_push($meals_Period, $meals_Day);
            }
            foreach ($meals_Period as $key => $meals) {
                foreach ($meals as $meal) {
                    if ($meal == $this->meal_id) {
                        $meal_count++;
                    }
                }
            }

        }

        return $meal_count;

    }


    public function quantity($meal_id, $request)
    {

        $qty = ReadyMeal::where('meal_id', $meal_id)->whereBetween('date', [$request['from'], $request['to']])->first();

        return $qty->quantity ?? '0';
    }
}

