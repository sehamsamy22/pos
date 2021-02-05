<?php

namespace App\Models;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = [
        'name','size_price','meal_id'
    ];
    public function meal(){
        return $this->belongsTo(Meal::class,'meal_id');
    }
    public function products()
    {
        return $this->hasMany(MealProduct::class, 'size_id');
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

                $meals_Day = Dietsystem::where(
                    'client_subscription_id',$subscription->id)
                    ->where(function($query)  use($day,$week){
                        $query-> where('day_No',$day);
                        return $query->where('week',$week);
                    })
                    ->pluck('size_id', 'id')->toArray();
                    array_push($meals_Period, $meals_Day);
            }
//            dd($meals_Day);
            foreach ($meals_Period as $key => $meals) {
                foreach ($meals as $meal) {
                    if ($meal == $this->id) {
                        $meal_count++;
                    }
                }
            }

        }

        return $meal_count;

    }

}
