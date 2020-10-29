<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubscriptionRequest;
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

      $subscription= Subscription::create($request->all());
   
      foreach($request['meal'] as $id){
        SubscriptionMeal::create([
            'subscription_id'=>$subscription->id,
            'type_id'=>$id
          ]);

      }
        return redirect()->route('dashboard.subscriptions.index')->with('success', 'تم اضافه نوع اشتراك  جديد');

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

}
