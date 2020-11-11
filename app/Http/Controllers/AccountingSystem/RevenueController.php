<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\ClientSubscriptions;
use App\Models\Revenue;
use App\Models\Revnue;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $revenues=Revenue::all();

        return view('admin.revenues.index',compact('revenues'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request['type']=='subscription'){
            $clients_subscription=ClientSubscriptions::find($request['client_subscription_id']);
            $clients_subscription->update([
                'payed'=>$clients_subscription->payed+$request['amount'],
                'reminder'=>$clients_subscription->reminder-$request['amount'],
            ]);
          Revenue::create([
                'client_subscription_id'=>$request['client_subscription_id'],
                'amount'=>$request['amount'],
                'type'=>'subscription'
            ]);
            
            return back()->with('success', 'تم  الدفع بنجاخ ');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Revnue  $revnue
     * @return \Illuminate\Http\Response
     */
    public function show(Revenue $revenue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Revnue  $revnue
     * @return \Illuminate\Http\Response
     */
    public function edit(Revenue $revenue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Revnue  $revnue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Revenue $revenue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Revnue  $revnue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Revenue $revenue)
    {
        $revenue->delete();
        return redirect()->route('dashboard.revenues.index')->with('success', __('تم الحذف بنجاح'));

    }
    public function payment_subscription($id){
       
        $clients_subscription=ClientSubscriptions::find($id);

        return view('admin.clients_subscriptions.payment',compact('clients_subscription'));

    }
}
