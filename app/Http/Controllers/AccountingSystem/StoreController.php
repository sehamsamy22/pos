<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientDriver;
use App\Models\ClientSubscriptions;
use App\Models\Meal;
use App\Models\MealProduct;
use App\Models\ReadyMeal;
use App\Models\ReceivedProduct;
use App\Models\StoreProduct;
use App\Models\Subscription;
use App\Models\SubscriptionMeal;
use App\Observers\ClientObsever;
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

    public function purchase_order(Request $request){
        // dd($request->all());
        if ($request->has('from') && $request->has('to')) {
            $subcriptipns_id=ClientSubscriptions::whereBetween('start',[$request['from'],$request['to']])
             ->orWhereBetween('end',[$request['from'],$request['to']])
             ->where('active','1')
             ->pluck('subscription_id','id')->toArray();
            $meals_=SubscriptionMeal::whereIn('subscription_id',$subcriptipns_id)->pluck('meal_id','id')->toArray();
            $allmeals=Meal::whereIn('id',$meals_)->pluck('id','id')->toArray();
            $products=MealProduct::whereIn('meal_id',$allmeals)->pluck('product_id','id')->toArray();
            $storeproducts=StoreProduct::whereIn('product_id',$products)->get();

         }else
        {
            $storeproducts=[];
            $request=[];
        }

        return view('admin.stores.purchase_order',compact('storeproducts','request'));

    }
    public function cooker_view(Request $request){
        if ($request->has('from') && $request->has('to')) {
            $subcriptipns_id=ClientSubscriptions::whereBetween('start',[$request['from'],$request['to']])
             ->orWhereBetween('end',[$request['from'],$request['to']])
             ->where('active','1')
            ->pluck('subscription_id','id')->toArray();

            $meals_=SubscriptionMeal::whereIn('subscription_id',$subcriptipns_id)->pluck('meal_id','id')->toArray();
            $meals=Meal::whereIn('id',$meals_)->get();
            $products=MealProduct::whereIn('meal_id',$meals)->pluck('product_id','id')->toArray();
            $storeproducts=StoreProduct::whereIn('product_id',$products)->get();

        }else
        {
            $storeproducts=[];
            $meals=[];
        }
        return view('admin.stores.cooker_view',compact('storeproducts','meals','request'));

    }

    public function receive_products(Request $request,$id){

        $store_product=StoreProduct::find($id);
        ///=======================store auantity update===================
        if($store_product->quantity > 0){
            $store_product->update([
                'quantity'=>$store_product->quantity -$request['received_quantity'],
            ]);
           $recevied= ReceivedProduct::where('product_id',$store_product->product->id)->where('date',Carbon::today())->first();
          if(isset($recevied)){
            $recevied->update([
                'quantity'=> $recevied->quantity+$request['received_quantity']
            ]);
           }else{
             ReceivedProduct::create([
                'product_id'=>$store_product->product->id,
                'quantity'=>$request['received_quantity'],
                'date'=>Carbon::today(),
            ]);
           }

            return response()->json([
                'status'=>true,
                'recevied'=>$recevied->quantity??$request['received_quantity'],
            ]);
        }else{
            return response()->json([
                'status'=>false,
            ]);
        }

    }

    public function ready_meals(Request $request,$id){

        $meal=Meal::find($id);
        $readymeal=ReadyMeal::where('meal_id',$id)->where('date',Carbon::today())->first();
       if(isset($readymeal)){

        $readymeal->update([
            'quantity'=>$readymeal->quantity + 1,
        ]);
       }
       else{
        ReadyMeal::create([
            'meal_id'=>$meal->id,
            'quantity'=>$request['quantity'],
            'date'=>Carbon::today(),
        ]);
       }

            return response()->json([
                'status'=>true,
                'readymeal'=>$readymeal->quantity,
            ]);
    }
    public function operarion_manger_view(){

        $readymeals=ReadyMeal::where('date',Carbon::today())->get();
        return view('admin.stores.operarion_manger_view',compact('readymeals'));

    }
    public function receive_meals(Request $request,$id){

        $meal=ReadyMeal::find($id);
        if($meal->received_quantity < $meal->quantity){
        $meal->update([
           'received_quantity'=> $meal->received_quantity+1,
        ]);
       }
            return response()->json([
                'status'=>true,
                'received_quantity'=>$meal->received_quantity
            ]);
    }
    public function distributed_meals(Request $request,$id){

        $meal=ReadyMeal::find($id);
        if($meal->distributed_quantity < $meal->quantity){

        $meal->update([
            'distributed_quantity'=> $meal->distributed_quantity+1,

        ]);
        }
            return response()->json([
                'status'=>true,
                'distributed_quantity'=> $meal->distributed_quantity,
            ]);
    }

    public function driver_manger_view(Request $request){

        if ($request->has('from') && $request->has('to')) {
            $subcriptipns_id=ClientSubscriptions::whereBetween('start',[$request['from'],$request['to']])
             ->orWhereBetween('end',[$request['from'],$request['to']])
             ->where('active','1')
            ->pluck('client_id','id')->toArray();
        $clients=Client::whereIn('id',$subcriptipns_id)->orderBy('address')->get();
        }else{
            $clients=[];
        }
        $users=User::where('role','driver')->get();
        return view('admin.stores.driver_manger_view',compact('clients','users'));
    }
    public function assign_driver(Request $request,$id){

                    ClientDriver::create([
                        'client_id'=>$id,
                        'user_id'=>$request['user_id'],
                        'date'=>Carbon::today(),
                    ]);

                    $driver=User::find($request['user_id']);
            return response()->json([
                'status'=>true,
                'data'=> $driver->name,
            ]);


    }
}
