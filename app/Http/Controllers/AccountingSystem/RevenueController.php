<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Http\Traits\RevenueOperation;
use App\Models\ClientSubscriptions;
use App\Models\Entry;
use App\Models\EntryAccount;
use App\Models\Product;
use App\Models\Revenue;
use App\Models\RevenueProduct;
use App\Models\Sale;
use App\Models\StoreProduct;
use App\Models\Supplier;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    use RevenueOperation;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->has('from') && $request->has('to')) {
            $revenues=Revenue::whereIn('type',['subscription','sale'])->whereBetween('date',[$request['from'],$request['to']])->get();
            $sum=Revenue::whereIn('type',['subscription','sale'])->whereBetween('date',[$request['from'],$request['to']])->sum('amount');

        }else{
            $revenues=Revenue::whereIn('type',['subscription','sale'])->get()->reverse();
            $sum=Revenue::whereIn('type',['subscription','sale'])->get()->sum('amount');
        }
        return view('admin.revenues.index',compact('revenues','sum'))
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
        if($request['type']=='subscription' ){
            $this->CreateRvenuesubscription($request);
            return redirect()->route('dashboard.revenues.index')->with('success', 'تم  انشاء السند بنجاخ ');
        }elseif($request['type']=='receipt'){
            $this->CreateRvenueReceipt($request);
            return redirect()->route('dashboard.revenues.receipt_index')->with('success', 'تم  انشاء السند بنجاخ ');
        }elseif($request['type']=='out'){
            $this->CreateRvenuestoreOut($request);
            return redirect()->route('dashboard.revenues.store_out_index')->with('success', 'تم  انشاء السند بنجاخ ');
        }elseif($request['type']=='sale' ){
            $this->CreateRvenuesale($request);
            return redirect()->route('dashboard.revenues.index')->with('success', 'تم  انشاء السند بنجاخ ');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Revnue  $revnue
     * @return \Illuminate\Http\Response
     */
    public function store_out_show($id)
    {
        $revenue=Revenue::find($id);
        $products=RevenueProduct::where('revenue_id',$id)->get();
        return view('admin.revenues.store_out_sanad_show',compact('revenue','products'));
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
        $revenue=Revenue::latest()->first();
        return view('admin.clients_subscriptions.payment',compact('clients_subscription','revenue'));

    }
    public function payment_sale($id){

        $sale=Sale::find($id);
        $revenue=Revenue::latest()->first();
        return view('admin.sales.payment',compact('sale','revenue'));

    }
    public function receipt(){
        $suppliers=Supplier::pluck('name','id')->toArray();
        $revenue=Revenue::latest()->first();
        return view('admin.revenues.receipt',compact('revenue','suppliers'));
    }
    public function store_out(){
        $stores=StoreProduct::pluck('product_id','id')->toArray();
        $products=Product::whereIn('id',$stores)->pluck('ar_name','id')->toArray();
        $revenue=Revenue::latest()->first();
        return view('admin.revenues.store_out_sanad',compact('revenue','products'));
    }
    public function receipt_index(Request $request)
    {

        if ($request->has('from') && $request->has('to')) {
            $revenues=Revenue::where('type','receipt')->whereBetween('date',[$request['from'],$request['to']])->get();
            $sum=Revenue::where('type','receipt')->whereBetween('date',[$request['from'],$request['to']])->sum('amount');

        }else{
            $revenues=Revenue::where('type','receipt')->get()->reverse();
            $sum=Revenue::where('type','receipt')->get()->sum('amount');
        }
        return view('admin.revenues.receipt_index',compact('revenues','sum'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function store_out_index(Request $request)
    {

        if ($request->has('from') && $request->has('to')) {
            $revenues=Revenue::where('type','out')->whereBetween('date',[$request['from'],$request['to']])->get();
            $sum=Revenue::where('type','out')->whereBetween('date',[$request['from'],$request['to']])->sum('amount');

        }else{
            $revenues=Revenue::where('type','out')->get()->reverse();
            $sum=Revenue::where('type','out')->get()->sum('amount');
        }
        return view('admin.revenues.store_out_index',compact('revenues','sum'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
