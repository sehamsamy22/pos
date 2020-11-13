<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientDriver;
use App\Models\ClientSubscriptions;
use App\Models\Meal;
use App\Models\ReadyMeal;
use App\Models\ReceivedProduct;
use App\Models\StoreProduct;
use App\Models\Subscription;
use App\Models\SubscriptionMeal;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $storeproducts=StoreProduct::all();

        return view('admin.stores.index',compact('storeproducts'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function purchase_order(){
        $storeproducts=StoreProduct::all();
        return view('admin.stores.purchase_order',compact('storeproducts'));

    }
    public function cooker_view(){
        $storeproducts=StoreProduct::all();
        $meals=[];
        $subcriptipns_id=ClientSubscriptions::where('end', '>=', Carbon::now()->tomorrow())->pluck('subscription_id','id')->toArray();
        $meals_=SubscriptionMeal::whereIn('subscription_id',$subcriptipns_id)->pluck('meal_id','id')->toArray();
      $meals=Meal::whereIn('id',$meals_)->get();
        return view('admin.stores.cooker_view',compact('storeproducts','meals'));

    }

    public function receive_products(Request $request,$id){
     
        $store_product=StoreProduct::find($id);
     
        ///=======================store auantity update===================
        if($store_product->quantity >= $request['quantity']){
            $store_product->update([
                'quantity'=>$store_product->quantity -$request['quantity'],
            ]);
            ReceivedProduct::create([
                'product_id'=>$store_product->product->id,
                'quantity'=>$request['quantity'],
                'date'=>Carbon::now()->tomorrow(),
            ]);
            return response()->json([
                'status'=>true,
                'data'=>$store_product->quantity,
            ]);
        }else{
            return response()->json([
                'status'=>false,
            ]);
        }
      
       
    }

    public function ready_meals(Request $request,$id){
     
        $meal=Meal::find($id);
        ReadyMeal::create([
                'meal_id'=>$meal->id,
                'quantity'=>$request['quantity'],
                'date'=>Carbon::now()->tomorrow(),
            ]);
            return response()->json([
                'status'=>true,
                'data'=>$meal->quantity,
            ]);     
    }
    public function operarion_manger_view(){
       
        $readymeals=ReadyMeal::where('date',Carbon::now()->tomorrow())->get();
        return view('admin.stores.operarion_manger_view',compact('readymeals'));

    }
    public function receive_meals(Request $request,$id){
     
        $meal=ReadyMeal::find($id);
        $meal->update([
           'received'=>1,
        ]);
            return response()->json([
                'status'=>true,
            ]);     
    }
    public function distributed_meals(Request $request,$id){
     
        $meal=ReadyMeal::find($id);
        $meal->update([
           'distributed'=>1,
        ]);
            return response()->json([
                'status'=>true,
            ]);     
    }

    public function driver_manger_view(){
       
        $subcriptipns=ClientSubscriptions::where('end', '>=', Carbon::now()->tomorrow())->pluck('client_id','id')->toArray();
        $clients=Client::whereIn('id',$subcriptipns)->orderBy('address')->get();
        $users=User::where('role','driver')->get();
        return view('admin.stores.driver_manger_view',compact('clients','users'));
    }
    public function assign_driver(Request $request,$id){

                    ClientDriver::create([
                        'client_id'=>$id,
                        'user_id'=>$request['user_id'],
                        'date'=>Carbon::now()->tomorrow(),
                    ]);

                    $driver=User::find($request['user_id']);
            return response()->json([
                'status'=>true,
                'data'=> $driver->name,
            ]);  


    }
}
