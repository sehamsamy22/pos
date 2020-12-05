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
       
        return view('admin.home.home',compact('subscriptions','purchases','meals','sales'));

    }
}
