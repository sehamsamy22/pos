<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Http\Traits\RevenueOperation;
use App\Models\Discount;
use App\Models\Meal;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    use RevenueOperation;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd( $request->all());
        if ($request->has('from') && $request->has('to')) {

                $purchases=Purchase::whereBetween('created_at',[$request['from'],$request['to']])->get()->reverse();

            }
            else{

          $purchases=Purchase::whereDate('created_at',Carbon::today())->get()->reverse();
        }

        return view('admin.purchases.index',compact('purchases'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers=Supplier::pluck('name','id')->toArray();
        $meals=Meal::all();
        $discounts=Discount::all();
        $purchaselast=Purchase::latest()->first();
        return view('admin.purchases.create',compact('suppliers','meals','purchaselast','discounts'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //    dd($request->all());
         $purchase=Purchase::create([
                'user_id'=>Auth::id(),
                'supplier_id'=>$request['supplier_id'],
                'date'=>$request['date'],
                'num'=>$request['num'],
                'amount'=>$request['amount'],
                'discount'=>$request['bill_discount'],
                'tax'=>$request['bill_tax'],
                'total'=>$request['total'],
                'payed'=>$request['payed'],
                'reminder'=>$request['total']-$request['payed'],
               'discount_id'=>$request['discount_id'],

         ]);
        $meals = collect($request['meal_id']);
        $qtys = collect($request['quantity']);
        $prices = collect($request['prices']);
        $itemTax = collect($request['taxs']);
        $discounts= collect($request['discounts']);

        $items = $meals->zip($qtys,$prices,$itemTax,$discounts);

        foreach ($items  as $item){
            PurchaseItem::create([
                'purchase_id'=>$purchase->id,
                'meal_id'=>$item[0],
                'quantity'=>$item[1],
                'total_price'=>$item[1]*$item[2],
                'tax'=>$item[3],
                'discount'=>$item[4],
                'price'=>$item[2]
            ]);
        }

        // $this->CreateRvenueReceipt($request);
        alert()->success('تم الشراء بنجاح !')->autoclose(5000);
        return redirect()->route('dashboard.purchases.index')->with('purchase_id',$purchase->id);;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        $items=PurchaseItem::where('purchase_id',$purchase->id)->get();

       return view('admin.purchases.show',compact('purchase','items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Purchase::find($id)->delete();
//        $purchase->delete();
        return redirect()->route('dashboard.purchases.index')->with('success', __('تم الحذف بنجاح'));

    }
//    public  function getProductAjex($id){
//

//        $product=Product::find($id);
//        return response()->json([
//            'data'=>$product
//        ]);
//    }
}


