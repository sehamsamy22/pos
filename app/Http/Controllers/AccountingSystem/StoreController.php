<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\ClientDriver;
use App\Models\ClientSubscriptions;
use App\Models\Dietsystem;
use App\Models\Meal;
use App\Models\MealProduct;
use App\Models\Product;
use App\Models\ProductLog;
use App\Models\ReadyMeal;
use App\Models\ReceivedProduct;
use App\Models\Size;
use App\Models\StoreProduct;
use App\Models\Subscription;
use App\Models\SubscriptionMeal;
use App\Observers\ClientObsever;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $categories=Category::pluck('name','id')->toArray();

        if($request->has('sub_category_id')){
            $allstoreproducts=StoreProduct::all();
            $cat=$request['sub_category_id'];

            $storeproducts
            = $allstoreproducts->filter(function($storeproduct) use ($cat)
            {
              if ($storeproduct->product->sub_category_id==$cat)
                   return $storeproduct ;
                 else
                   return null;

        });

        }
else{
            $storeproducts=StoreProduct::all();
        }


        return view('admin.stores.index',compact('storeproducts','categories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function show(Request  $request,$id){
      $product=Product::find($id);
        if ($request->has('from') && $request->has('to')) {
            $logs = ProductLog::where('product_id', $id)->whereBetween('created_at',[$request['from'],$request['to']])->get();
        }else{
            $logs = ProductLog::where('product_id', $id)->get();

        }
        return view('admin.stores.log',compact('logs','product'));
    }


    public function purchase_order(Request $request){
        // dd($request->all());
        if ($request->has('from') && $request->has('to')) {
            $subcriptipns_id=ClientSubscriptions::where('active','1')
             ->pluck('id')->toArray();

            $meals_=Dietsystem::whereIn('client_subscription_id',$subcriptipns_id)->pluck('meal_id','id')->toArray();
//
            $allmeals=Meal::whereIn('id',$meals_)->pluck('id')->toArray();
            $products=MealProduct::whereIn('meal_id',$allmeals)->pluck('product_id','id')->toArray();
//            dd($products);
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
            $subcriptipns_id=ClientSubscriptions::where('active','1')
            ->pluck('id')->toArray();
            $sizes_=Dietsystem::whereIn('client_subscription_id',$subcriptipns_id)
                ->pluck('size_id','id')->toArray();
            $sizes=Size::whereIn('id',$sizes_)->get();
            $sizes_id=Size::whereIn('id',$sizes_)->pluck('id','id')->toArray();
            $products=MealProduct::whereIn('size_id',$sizes_id)->pluck('product_id','id')->toArray();
            $storeproducts=StoreProduct::whereIn('product_id',$products)->get();
//        dd($meals);
        }else
        {
            $storeproducts=[];
            $sizes=[];

        }
        return view('admin.stores.cooker_view',compact('storeproducts','sizes','request'));

    }

    public function receive_products(Request $request,$id){

        $store_product=StoreProduct::find($id);
//        dd($request['received_quantity']);
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
        $mealSize=Size::find($id);
        if ($request->has('from') && $request->has('to')) {
//            dd("sadas");
            $readymeal = ReadyMeal::where('size_id', $id)->whereBetween('created_at',[$request['from'],$request['to']])->first();
            if (isset($readymeal)) {
                $readymeal->update([
                    'quantity' => $readymeal->quantity + $request['quantity'],
                ]);
            } else {
                ReadyMeal::create([
                    'meal_id' => $mealSize->id,
                    'size_id' =>$mealSize->meal->id,
                    'quantity' => $request['quantity'],
                    'date' => Carbon::today(),
                ]);
            }
        }
            return response()->json([
                'status'=>true,
                'readymeal'=>$readymeal->quantity ?? $request['quantity'],
            ]);
    }
    public function operarion_manger_view(Request  $request){
        if ($request->has('from') && $request->has('to')) {
            $readymeals = ReadyMeal::whereBetween('date',[$request['from'],$request['to']])->get();
        }else{
            $readymeals=[];
        }
        return view('admin.stores.operarion_manger_view',compact('readymeals'));

    }
    public function receive_meals(Request $request,$id){
        $meal=ReadyMeal::find($id);
        $meal->update([
            'received'=>1,
           'received_quantity'=> $meal->received_quantity+$meal->quantity,
        ]);
            return response()->json([
                'status'=>true,
                'received_quantity'=>$meal->received_quantity
            ]);
    }
    public function distributed_meals(Request $request,$id){
        $meal=ReadyMeal::find($id);
        $meal->update([
            'distributed'=>1,
            'distributed_quantity'=> $meal->distributed_quantity+$meal->quantity,
        ]);
            return response()->json([
                'status'=>true,
                'distributed_quantity'=> $meal->distributed_quantity,
            ]);
    }

    public function driver_manger_view(Request $request){
        $logs = ClientDriver::all();

        if ($request->has('from') && $request->has('to')) {
            $subcriptipns_id=ClientSubscriptions::
             where('active','1')
            ->pluck('client_id','id')->toArray();
        $clients=Client::whereIn('id',$subcriptipns_id)->orderBy('area_id')->get();
            $logs = ClientDriver::whereBetween('created_at',[$request['from'],$request['to']])->get();

        }else{
            $clients=[];
        }
        $users=User::where('role','driver')->orderBy('area_id')->get();
        return view('admin.stores.driver_manger_view',compact('clients','users','logs'));
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
    public function productout(Request $request){
        $products=Product::whereIn('id',$request['ids'])->get();
        return response()->json([
            'status'=>true,
          'data'=>view('admin.revenues.product',compact('products'))->render()
        ]);
    }

    public  function meals_label(Request $request,$id){

        $Ready_meal=ReadyMeal::find($id);
        $meal=Meal::find($Ready_meal->meal_id);
        $subscriptions=SubscriptionMeal::where('meal_id',$meal->id)
            ->pluck('subscription_id','id')->toArray();
        if ($request->has('from') && $request->has('to')) {
            $client_id = ClientSubscriptions::where('active', '1')
//                ->whereBetween('created_at',[$request['from'],$request['to']])
                ->whereIn('subscription_id',$subscriptions)
                ->pluck('client_id', 'id')->toArray();
           $clients=Client::whereIn('id',$client_id)->get();

        }else{
            $clients=[];
        }
        return response()->json([
            'status'=>true,
            'data'=>view('admin.stores.meals_label',compact('clients','Ready_meal'))->render()
        ]);
    }
    public  function client_log(Request $request,$id){

        $client=Client::find($id);
        if ($request->has('from') && $request->has('to')) {
            $logs = ClientDriver::where('client_id', $id)->whereBetween('created_at',[$request['from'],$request['to']])->get();
        }else{
            $logs = ClientDriver::where('client_id', $id)->get();

        }
        return view('admin.stores.client_log',compact('logs','client'));
    }

}
