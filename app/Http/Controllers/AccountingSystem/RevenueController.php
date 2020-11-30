<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\ClientSubscriptions;
use App\Models\Entry;
use App\Models\EntryAccount;
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

        $revenues=Revenue::all()->reverse();

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
        $revenue=  Revenue::create([
                'client_subscription_id'=>$request['client_subscription_id'],
                'amount'=>$request['amount'],
                'type'=>'subscription',
                "payment_type" => "veza"

            ]);

            // $table->enum('payment_type',['cash','master','veza','mada'])->nullable();

            if($request['payment_type']=='cash')
                {
                    $entry=Entry::create([
                        'date'=>$revenue->created_at,
                            'source'=>'سند قبض اشتراكات',
                            'type'=>'automatic',
                            'details'=>'سند قبض اشتراكات',
                            'status'=>'new',
                    ]);

                     EntryAccount::create([
                        'entry_id'=>$entry->id,
                        'account_id'=> $clients_subscription->client_id,
                        'affect'=>'debtor',
                        'amount'=>$request['amount'],
                    ]);
                    EntryAccount::create([
                        'entry_id'=>$entry->id,
                        'account_id'=> getsetting('cash'),
                        'affect'=>'creditor',
                        'amount'=>$request['amount'],
                    ]);


                }elseif($request['payment_type']=='mada')
                {
                    $entry=Entry::create([
                        'date'=>$revenue->created_at,
                            'source'=>'سند قبض اشتراكات',
                            'type'=>'automatic',
                            'details'=>'سند قبض اشتراكات',
                            'status'=>'new',
                    ]);

                     EntryAccount::create([
                        'entry_id'=>$entry->id,
                        'account_id'=> $clients_subscription->client_id,
                        'affect'=>'debtor',
                        'amount'=>$request['amount'],
                    ]);
                    EntryAccount::create([
                        'entry_id'=>$entry->id,
                        'account_id'=> getsetting('mada'),
                        'affect'=>'creditor',
                        'amount'=>$request['amount'],
                    ]);


                }




                return redirect()->route('dashboard.revenues.index')->with('success', 'تم  الدفع بنجاخ ');

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
