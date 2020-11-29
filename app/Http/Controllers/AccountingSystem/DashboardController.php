<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientSubscriptions;
use App\Models\Meal;
use App\Models\ReadyMeal;
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
        $clients=Client::count();
        $meals=ReadyMeal::whereDate('date',Carbon::today())->count();
        $suppliers=Supplier::count();
        return view('admin.home.home',compact('subscriptions','clients','meals','suppliers'));
    }
}
