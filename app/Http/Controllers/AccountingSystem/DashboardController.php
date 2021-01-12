<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientSubscriptions;
use App\Models\Meal;
use App\Models\Purchase;
use App\Models\ReadyMeal;
use App\Models\Sale;
use App\Models\Subscription;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
// dd(Carbon::now()->today());
        $subscriptions=ClientSubscriptions::whereDate('end', '>=', Carbon::today())->whereDate('start', '<', Carbon::today())->count();
        $meals=ReadyMeal::whereDate('date',Carbon::today())->count();
        $purchases=Purchase::whereDate('created_at',Carbon::now()->today())->sum('payed');
        $sales=Sale::whereDate('created_at',Carbon::now()->today())->sum('payed');
        $subscriptions_client=ClientSubscriptions::whereDate('created_at',Carbon::now()->today())->sum('payed');
        $subscription_cat= \DB::table('client_subscriptions')->groupBy('subscription_id')->selectRaw('count(id) as count,client_id,subscription_id')->get()->mapWithKeys(function ($q){
            return[$q->subscription_id=>[
                'count'=>$q->count,
           'name'=>Subscription::find($q->subscription_id)->name,
            ]];
        })->toArray();
//        $sales= \DB::table('sales')->groupBy('date')->selectRaw('sum(total) as sum,date,created_at')->get()->mapWithKeys(function ($q){
//            return[$q->created_at=>[
//                'sum'=>$q->sum,
//                'date'=>$q->created_at,
//            ]];
//        })->toArray();

        $sales_year = [];
             $name='';
// Circle trough all 12 months
        for ($month = 1; $month <= 12; $month++) {
            // Create a Carbon object from the current year and the current month (equals 2019-01-01 00:00:00)
            $date = Carbon::create(date('Y'), $month);
            // Make a copy of the start date and move to the end of the month (e.g. 2019-01-31 23:59:59)
            $date_end = $date->copy()->endOfMonth();
            $sales_ = Sale::
                // the creation date must be between the start of the month and the end of the month
                where('created_at', '>=', $date)
                ->where('created_at', '<=', $date_end)
                // ->Where('status','!=','Menunggu')
                ->sum('total');
            if ($month==1){
                $name='يناير';
            }elseif($month==2){
                $name='فبراير';
            }elseif($month==3){
                $name='مارس';
            }elseif($month==4){
                $name='ابريل';
            }elseif($month==5){
                $name='مايو';
            }elseif($month==6){
                $name='يونية';
            }elseif($month==7){
                $name='يوليو';
            }elseif($month==8){
                $name='اغسطس';
            }elseif($month==9){
                $name='سبتمبر';
            }elseif($month==10){
                $name='اكتوبر';
            }elseif($month==11){
                $name='نوفمبر';
            }elseif($month==12){
                $name='ديسمبر';
            }
            // Save the count of transactions for the current month in the output array
            $sales_year[$name] = $sales_;
        }


        $Profit_year = [];
        $name='';
        for ($month = 1; $month <= 12; $month++) {
            $date = Carbon::create(date('Y'), $month);
            $date_end = $date->copy()->endOfMonth();
            $sales_ = Sale::where('created_at', '>=', $date)->where('created_at', '<=', $date_end)->sum('total');
            $purchases_ = Purchase::where('created_at', '>=', $date)->where('created_at', '<=', $date_end)->sum('total');
            if ($month==1){
                $name='يناير';
            }elseif($month==2){
                $name='فبراير';
            }elseif($month==3){
                $name='مارس';
            }elseif($month==4){
                $name='ابريل';
            }elseif($month==5){
                $name='مايو';
            }elseif($month==6){
                $name='يونية';
            }elseif($month==7){
                $name='يوليو';
            }elseif($month==8){
                $name='اغسطس';
            }elseif($month==9){
                $name='سبتمبر';
            }elseif($month==10){
                $name='اكتوبر';
            }elseif($month==11){
                $name='نوفمبر';
            }elseif($month==12){
                $name='ديسمبر';
            }
            $Profit_year[$name] = [$sales_,$purchases_];
        }
//dd($Profit_year);
        return view('admin.home.home',compact('subscriptions','purchases','meals','sales','subscription_cat','sales_year','Profit_year','subscriptions_client'));

    }
}
