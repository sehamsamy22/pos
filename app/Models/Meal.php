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

    public function typeMeal()
    {
        return $this->belongsTo(TypeMeal::class, 'type_id');
    }

    public function readymeals($id, $request)
    {
        $qty = ReadyMeal::where('meal_id', $id)->whereBetween('date', [$request['from'], $request['to']])->sum('quantity');
        return $qty;
    }

    function quantity_meal($meals, $meal_count, $ferq)
    {

        foreach ($meals as $meal) {
            if ($meal == $this->id) {
                $meal_count++;
            }
        }

        return $meal_count;
    }
    public function orders($id, $request)
    {
        $from = $request['from'];
        $to = $request['to'];
        //-------------------------array1--------------------------

        $total=0;
        $subscriptions_arr = ClientSubscriptions::where('active', '1')->get();
        // dd($subscriptions_arr);
        $meal_count_sat=0; $meal_count_sun=0; $meal_count_mon=0;$meal_count_tue =0;$meal_count_wed=0;$meal_count_thu=0; $meal_count_fri=0;
        $meal_count = 0;
        foreach ($subscriptions_arr as $key=>$subscription) {

            $subscription_meal = Dietsystem::where('client_subscription_id', $subscription->id)->where('meal_id', $id)->first();
            if (isset($subscription_meal)) {
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
                        $days['Sat'] = 1;
                    } elseif ($date == 'Sun') {
                        $days['Sun'] = 1;
                    } elseif ($date == 'Mon') {
                        $days['Mon'] = 1;
                    } elseif ($date == 'Tue') {
                        $days['Tue'] = 1;
                    } elseif ($date == 'Wed') {
                        $days['Wed'] = 1;
                    } elseif ($date == 'Thu') {
                        $days['Thu'] = 1;
                    } elseif ($date == 'Fri') {
                        $days['Fri'] = 1;
                    }
                }
                //    dd($days);
//-------------------------array2--------------------------
                $all = array('Sat' => 0, 'Sun' => 0, 'Mon' => 0, 'Tue' => 0, 'Wed' => 0, 'Thu' => 0, 'Fri' => 0);
                $saterday_meals = Dietsystem::where('client_subscription_id', $subscription->id)->where('day_No', '1')->pluck('meal_id', 'id')->toArray();
                $sunday_meals = Dietsystem::where('client_subscription_id', $subscription->id)->where('day_No', '2')->pluck('meal_id', 'id')->toArray();
                $monday_meals = Dietsystem::where('client_subscription_id', $subscription->id)->where('day_No', '3')->pluck('meal_id', 'id')->toArray();
                $tusday_meals = Dietsystem::where('client_subscription_id', $subscription->id)->where('day_No', '4')->pluck('meal_id', 'id')->toArray();
                $wensday_meals = Dietsystem::where('client_subscription_id', $subscription->id)->where('day_No', '5')->pluck('meal_id', 'id')->toArray();
                $thurday_meals = Dietsystem::where('client_subscription_id', $subscription->id)->where('day_No', '6')->pluck('meal_id', 'id')->toArray();
                $friday_meals = Dietsystem::where('client_subscription_id', $subscription->id)->where('day_No', '7')->pluck('meal_id', 'id')->toArray();
// dd($sunday_meals);
                $all['Sat'] = $saterday_meals;
                $all['Sun'] = $sunday_meals;
                $all['Mon'] = $monday_meals;
                $all['Tue'] = $tusday_meals;
                $all['Wed'] = $wensday_meals;
                $all['Thu'] = $thurday_meals;
                $all['Fri'] = $friday_meals;
                //-------------------------array3--------------------------
                foreach ($all as $day => $meals) {
                    if ($day == 'Sat') {
                        $meal_count_sat+= $this->quantity_meal($meals, $meal_count , $days['Sat'])*$days['Sat'];
                    } else if ($day == 'Sun') {
                        $meal_count_sun+= $this->quantity_meal($meals, $meal_count , $days['Sun'])*$days['Sun'];
                    } else if ($day == 'Mon') {
                        $meal_count_mon+= $this->quantity_meal($meals, $meal_count , $days['Mon'])*$days['Mon'];
                    } else if ($day == 'Tue') {
                        $meal_count_tue+= $this->quantity_meal($meals, $meal_count , $days['Tue'])*$days['Tue'];
                    } else if ($day == 'Wed') {
                        $wed = $this->quantity_meal($meals, $meal_count , $days['Wed']);

                        $meal_count_wed+= $wed*$days['Wed'];
                    } else if ($day == 'Thu') {
                        $meal_count_thu += $this->quantity_meal($meals, $meal_count , $days['Thu'])*$days['Thu'];
                    } else if ($day == 'Fri') {
                        $meal_count_fri+= $this->quantity_meal($meals, $meal_count = 0, $days['Fri'])*$days['Fri'];
                    }
                }

            }//if check isset $subscription_meal
            $total= $meal_count_sat + $meal_count_sun + $meal_count_mon+ $meal_count_tue + $meal_count_wed + $meal_count_thu + $meal_count_fri;

        }//foreach end





        return $total;
    }


    public function quantity($meal_id, $request)
    {

        $qty = ReadyMeal::where('meal_id', $meal_id)->whereBetween('date', [$request['from'], $request['to']])->first();

        return $qty->quantity ?? '0';
    }
}

