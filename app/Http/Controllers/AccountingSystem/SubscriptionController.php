<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriptionRequest;
use App\Models\ClientSubscriptions;
use App\Models\Meal;
use App\Models\Subscription;
use App\Models\SubscriptionMeal;
use App\Models\TypeMeal;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriptions=Subscription::all();

        return view('admin.subscriptions.index',compact('subscriptions'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types=TypeMeal::all();
        $typesArray=TypeMeal::pluck('name')->toArray();
        return view('admin.subscriptions.create',compact('types','typesArray'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubscriptionRequest $request)
    {

//    dd($request->all());
      $subscription= Subscription::create($request->all());
        if (isset($request['products'])){
              foreach($request['products'] as $key=>$meals) {
                  $key_array = preg_split('//', $key, -1, PREG_SPLIT_NO_EMPTY);
               foreach ($meals as $meal ){
                   SubscriptionMeal::create([
                       'subscription_id' => $subscription->id,
                       'meal_id' => $meal,
                       'week'=>$key_array[0],
                       'day'=>$key_array[1],
                   ]);
               }

              }
      }
        return redirect()->route('dashboard.subscriptions.index')->with('success', 'تم اضافه نوع اشتراك  جديد');

    }
    public function subscription_meal(Request  $request){
        SubscriptionMeal::find($request['id'])->delete();
        return response()->json([
            'success'=>'تم الحذف بنجاح'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
        $types=TypeMeal::all();
        $typesArray=TypeMeal::pluck('name')->toArray();
        return view('admin.subscriptions.edit', compact('subscription','types','typesArray'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(SubscriptionRequest $request, Subscription $subscription)
    {
//     dd($subscription);
        $subscription->update($request->all());
        if (isset($request['products'])){
            foreach($request['products'] as $key=>$meals) {
                $key_array = preg_split('//', $key, -1, PREG_SPLIT_NO_EMPTY);
                foreach ($meals as $meal ){
                    SubscriptionMeal::create([
                        'subscription_id' => $subscription->id,
                        'meal_id' => $meal,
                        'week'=>$key_array[0],
                        'day'=>$key_array[1],
                    ]);
                }

            }
        }

        return redirect()->route('dashboard.subscriptions.index')->with('success', __('تم التعديل'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

       Subscription::find($id)->delete();
        return redirect()->route('dashboard.subscriptions.index')->with('success', __('تم الحذف بنجاح'));
    }

   public function deleteMeal($id){

       SubscriptionMeal::find($id)->delete($id);

       return response()->json([
           'success' => 'Record deleted successfully!'
       ]);

   }

    public function getMealInputs(Request $request,$id){
        $num=$request['num'];
        $meals=Meal::where('type_id',$id)->get();;
        return response()->json([
            'status'=>true,
            'data'=>view('admin.subscriptions.products',compact('meals','num'))->render()
        ]);
    }
    public  function subscription_disactive(Request  $request,$id){
      $subscription=ClientSubscriptions::find($id);

        $subscription->update([
            'end'=>$request['end'],
            'active'=>0,
        ]);
        return redirect()->route('dashboard.clients_subscriptions.index')->with('success', __('تم ايقاف الاشتراك بنجاح'));
    }

    public  function subscription_active($id){
        $subscription=ClientSubscriptions::find($id);

        $subscription->update([
            'active'=>1,
        ]);
        return redirect()->route('dashboard.clients_subscriptions.index')->with('success', __('تم تفعيل الاشتراك بنجاح'));

    }

    public function copy($id)
    {

        $subscription = Subscription::find($id);
        $new_subscription = $subscription->replicate();
        $new_subscription->push();
//        $new_subscription->products()->create($subscription->products);
        foreach($subscription->meals as $meal) {
            $new_meal = $meal->replicate();
            $new_meal->subscription_id = $new_subscription->id;
            $new_meal->push();
        }

        return redirect()->route('dashboard.subscriptions.index')->with('success', __('تم نسخ الاشتراك بنجاح'));
    }
}
