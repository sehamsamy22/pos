<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriptionRequest;
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
        $types=TypeMeal::pluck('name','id')->toArray();

        return view('admin.subscriptions.create',compact('types'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubscriptionRequest $request)
    {

        // dd($request->all());
      $subscription= Subscription::create($request->all());

      foreach($request['meals'] as $id){
        SubscriptionMeal::create([
            'subscription_id'=>$subscription->id,
            'meal_id'=>$id
          ]);

      }
        return redirect()->route('dashboard.subscriptions.index')->with('success', 'تم اضافه نوع اشتراك  جديد');

    }
    public function subscription_meal($id){
        $meal=SubscriptionMeal::find($id);
        $meal->delete();

        return back()->with('success', __('تم الحذف بنجاح'));
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
        $types=TypeMeal::pluck('name','id')->toArray();
        // $meals=Meal::all();
        return view('admin.subscriptions.edit', compact('subscription','types'));

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
        $subscription->update($request->all());
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


    public function getMealInputs($id){

        $meals=Meal::where('type_id',$id)->get();;
        return response()->json([
            'status'=>true,
            'data'=>view('admin.subscriptions.meals',compact('meals'))->render()
        ]);
    }

}
