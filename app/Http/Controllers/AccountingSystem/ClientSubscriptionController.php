<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientSubscriptionRequest;
use App\Models\Client;
use App\Models\ClientSubscriptions;
use App\Models\Dietsystem;
use App\Models\Meal;
use App\Models\Measurement;
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
        $subscriptions=Subscription::pluck('name','id')->toArray();
        $clients=Client::pluck('name','id')->toArray();

        return view('admin.clients_subscriptions.create',compact('measurements','subscriptions','clients'));

    }
    public function store(ClientSubscriptionRequest $request){

        $clientSubsription=ClientSubscriptions::create($request->all());
            foreach ($request['meals'] as $mealkey=>$meal){
                foreach($meal as $daykey=>$day){
                    Dietsystem::create([
                        'client_subscription_id'=>$clientSubsription->id,
                        'meal_id'=>$mealkey,
                        'day_No'=>$daykey
                    ]);
               }
            }
        return back()->with('success', 'تم اضافه اشتراك العميل بنجاخ ');

    }


    public function dietsystems_update(Request $request,$id){

            $dietsystems=Dietsystem::where('client_subscription_id',$id)->delete();
            foreach ($request['meals'] as $mealkey=>$meal){
                foreach($meal as $daykey=>$day){
                    Dietsystem::create([
                        'client_subscription_id'=>$id,
                        'meal_id'=>$mealkey,
                        'day_No'=>$daykey
                    ]);
               }
            }
        return back()->with('success', 'تم تعديل النظام الغذائى بنجاخ ');

    }
    public function destroy($id )
    {
        ClientSubscriptions::find($id)->delete();
        return redirect()->route('dashboard.clients_subscriptions.index')->with('success', __('تم الحذف بنجاح'));

    }
    public function add_subscription($id)
    {
        $measurements=Measurement::all();
        $subscriptions=Subscription::pluck('name','id')->toArray();
        $clients=Client::pluck('name','id')->toArray();

        $client = Client::find($id);

        return view('admin.clients_subscriptions.create',compact('measurements','subscriptions','clients','client'));

    }

    public function dietsystems($id){
        $types=TypeMeal::all();
            $dietsystems=Dietsystem::where('client_subscription_id',$id)->get();
            $clientSubsription=ClientSubscriptions::find($id);
        return view('admin.clients_subscriptions.dietsystems',compact('dietsystems','clientSubsription','types'));

    }
    public function dietsystems_edit($id){
        $types=TypeMeal::all();
        $dietsystems=Dietsystem::where('client_subscription_id',$id)->get();
        $clientSubsription=ClientSubscriptions::find($id);
    return view('admin.clients_subscriptions.dietsystems_edit',compact('dietsystems','clientSubsription','types'));

}

    public  function getEndDateAjex(Request $request,$id){

       $subscription=Subscription::find($id);

        $start= Carbon::parse($request['start_date']);
       $endDate=$start->addDays($subscription->duration)->toDateString();
// dd($endDate);
        return response()->json([
          'data'=>$endDate
        ]);
    }

    public  function getMealTable($id){

        $subscription=Subscription::find($id);
        $subscriptionMeal=SubscriptionMeal::where('subscription_id',$id)->pluck('meal_id','id')->toArray();
        $meals=TypeMeal::whereIn('id',$subscriptionMeal)->get();
        $types=TypeMeal::all();

              return response()->json([
                'status'=>true,
                'price'=>$subscription->price,
                'data'=>view('admin.clients_subscriptions.meals',compact('meals','types','id'))->render()
            ]);
     }
}
