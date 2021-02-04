<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientSubscriptionRequest;
use App\Models\Client;
use App\Models\ClientSubscriptions;
use App\Models\Dietsystem;
use App\Models\Meal;
use App\Models\Measurement;
use App\Models\Revenue;
use App\Models\Revnue;
use App\Models\SubscriptionMeal;
use App\Models\Subscription;
use App\Models\TypeMeal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClientSubscriptionController extends Controller
{
    public  function  index(){
        $clients_subscriptions=ClientSubscriptions::all();
        return view('admin.clients_subscriptions.index',compact('clients_subscriptions'));
    }
    public function create()
    {
        $measurements=Measurement::all();
        $subscriptions=Subscription::all();
        $clients=Client::pluck('name','id')->toArray();
        $types=TypeMeal::all();
        return view('admin.clients_subscriptions.create',compact('measurements','subscriptions','clients','types'));

    }
    public function store(ClientSubscriptionRequest $request){

        $request['end'] =date("Y-m-d", strtotime($request['end']));
        $clientSubsription=ClientSubscriptions::create($request->all());
        $clientSubsription->update([
            'reminder'=>$clientSubsription->total-$clientSubsription->payed,
        ]);
        if(isset($request['meals'])){
            foreach ($request['meals']  as $key=>$sizes){
                $key_array = preg_split('//', $key, -1, PREG_SPLIT_NO_EMPTY);
                foreach($sizes as $daykey=>$size){
                    Dietsystem::create([
                        'client_subscription_id'=>$clientSubsription->id,
                        'size_id'=>$size->id,
                        'day_No'=>$key_array[1],
                        'week'=>$key_array[0],
                        'meal_id'=>$size->meal->id,

                    ]);
               }
            }
            Revenue::create([
                'client_subscription_id'=>$clientSubsription->id,
                'sale_id'=>Null,
                'type'=>'subscription',
                'amount'=>$clientSubsription->payed,
            ]);
            }
            return redirect()->route('dashboard.clients_subscriptions.index')->with('success', 'تم اضافه اشتراك العميل بنجاخ ');

    }
    public function show($id)
    {
        $clientSubsription=ClientSubscriptions::find($id);
        $types=TypeMeal::all();
        $dietsystems=Dietsystem::where('client_subscription_id',$clientSubsription->id)->get();

        return view('admin.clients_subscriptions.show', compact('clientSubsription','types','dietsystems'));
    }


    public function update(Request $request,$id){
//            dd($request->all());
//        dd(Carbon::parse($request['end'])->format('Y-m-d'));
        $client_subscription=ClientSubscriptions::find($id);
//            $dietsystems=Dietsystem::where('client_subscription_id',$id)->delete();

    $client_subscription=ClientSubscriptions::create([
        'client_id'=> $client_subscription->client_id,
        'subscription_id'=>$client_subscription->subscription_id,
        'start'=>$request['start'],
        'end'=>Carbon::parse($request['end'])->format('Y-m-d'),
        'total'=>$client_subscription->total,
        'active'=>1,
        'tax'=>$client_subscription->tax,
        'payed'=>$client_subscription->payed,
        'reminder'=>$client_subscription->reminder,
        'payment_type'=>$client_subscription->payment_type,
    ]);
        $dietsystems=Dietsystem::where('client_subscription_id',$id)->get();
        foreach ($dietsystems as $day){
            Dietsystem::create([
                'client_subscription_id'=>$client_subscription->id,
                'meal_id'=>$day->meal_id,
                'day_No'=>$day->day_No,
            ]);
        }
        return redirect()->route('dashboard.clients_subscriptions.index')->with('success', __('  تم تجديد الاشتراك بنجاخ'));

        return back()->with('success', 'تم تجديد الاشتراك بنجاخ ');
    }
    public function destroy($id )
    {
        ClientSubscriptions::find($id)->delete();
        return redirect()->route('dashboard.clients_subscriptions.index')->with('success', __('تم الحذف بنجاح'));

    }
    public function add_subscription($id)
    {
        $measurements=Measurement::all();
        $subscriptions=Subscription::all();
        $clients=Client::pluck('name','id')->toArray();
        $client = Client::find($id);
        $types=TypeMeal::all();
        return view('admin.clients_subscriptions.create',compact('measurements','types','subscriptions','clients','client'));

    }

    public function dietsystems($id){
        $clientSubsription=ClientSubscriptions::find($id);
        $types=TypeMeal::all();
        $dietsystems=Dietsystem::where('client_subscription_id',$clientSubsription->id)->get();

        return view('admin.clients_subscriptions.dietsystems',compact('dietsystems','clientSubsription','types'));

    }
    public function edit($id){
//        dd($id);
        $subscriptions=Subscription::all();
        $clientSubsription=ClientSubscriptions::find($id);
        $types=TypeMeal::all();
        $dietsystems=Dietsystem::where('client_subscription_id',$id)->get();
//        dd($dietsystems);
        return view('admin.clients_subscriptions.edit',compact('dietsystems','clientSubsription','types','subscriptions'));

}



    public  function getMealTable($id){

        $subscription=Subscription::find($id);
        $MealsWeek1=SubscriptionMeal::where('subscription_id',$id)
           ->where('week','1')->pluck('meal_id','id')->toArray();
        $MealsWeek2=SubscriptionMeal::where('subscription_id',$id)
            ->where('week','2')->pluck('meal_id','id')->toArray();
        $MealsWeek3=SubscriptionMeal::where('subscription_id',$id)
            ->where('week','3')->pluck('meal_id','id')->toArray();
        $MealsWeek4=SubscriptionMeal::where('subscription_id',$id)
            ->where('week','4')->pluck('meal_id','id')->toArray();
//        $meals=TypeMeal::whereIn('id',$subscriptionMeal)->get();
        $types=TypeMeal::all();

              return response()->json([
                'status'=>true,
                'price'=>$subscription->price,
                'week1'=>view('admin.clients_subscriptions.week1',compact('types','id'))->render(),
                  'week2'=>view('admin.clients_subscriptions.week2',compact('types','id'))->render(),
                  'week3'=>view('admin.clients_subscriptions.week3',compact('types','id'))->render(),
                  'week4'=>view('admin.clients_subscriptions.week4',compact('types','id'))->render(),
            ]);
     }

    public function dietsystems_update(Request $request,$id){

        $dietsystems=Dietsystem::where('client_subscription_id',$id)->delete();
        if(isset($request['meals'])) {
            foreach ($request['meals'] as $key => $meals) {
                $key_array = preg_split('//', $key, -1, PREG_SPLIT_NO_EMPTY);
                foreach ($meals as $daykey => $mael) {
                    Dietsystem::create([
                        'client_subscription_id' => $id,
                        'meal_id' => $mael,
                        'day_No' => $key_array[1],
                        'week' => $key_array[0],
                    ]);
                }
            }
        }
        return back()->with('success', 'تم تعديل النظام الغذائى بنجاخ ');
    }
    public function dietsystems_edit($id){
        $clientSubsription=ClientSubscriptions::find($id);
        $types=TypeMeal::all();
        $dietsystems=Dietsystem::where('client_subscription_id',$id)->get();

        return view('admin.clients_subscriptions.dietsystems_edit',compact('dietsystems','clientSubsription','types'));

    }
}
