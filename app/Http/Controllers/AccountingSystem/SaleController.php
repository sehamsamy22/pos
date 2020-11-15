<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Meal;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales=Sale::all();

        return view('admin.sales.index',compact('sales'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients=Client::pluck('name','id')->toArray();
        $products=Product::all();
        $categories=Category::all();
        return view('admin.sales.create',compact('clients','products','categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $sale=Sale::create([
            'user_id'=>Auth::id(),
            'client_id'=>$request['client_id'],
            'date'=>$request['date'],
            'num'=>$request['num'],
            'amount'=>$request['amount'],
            'discount'=>$request['discount'],
            'total'=>$request['total'],

        ]);
        $meals = collect($request['meal_id']);
        $qtys = collect($request['quantity']);
        $prices = collect($request['prices']);
        $items = $meals->zip($qtys,$prices);
        foreach ($items as $item){
            SaleItem::create([
                'sale_id'=>$sale->id,
                'meal_id'=>$item[0],
                'quantity'=>$item[1],
                'total_price'=>$item[1]*$item[2],
            ]);
        }

        alert()->success('تم البيع بنجاح !')->autoclose(5000);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        $items=SaleItem::where('sale_id',$sale->id)->get();
        return view('admin.sales.show',compact('sale','items'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->route('dashboard.sales.index')->with('success', __('تم الحذف بنجاح'));

    }

    public  function  getAllSubcategories($id){
        $subcategories=SubCategory::where('category_id',$id)->get();
        return response()->json([
            'status'=>true,
            'data'=>view('admin.sales.subcategories')->with('subcategories',$subcategories)->render()
        ]);
    }
    public  function  getAllcategories(){
        $categories=Category::all();
        return response()->json([
            'status'=>true,
            'data'=>view('admin.sales.categories')->with('categories',$categories)->render()
        ]);
    }


    public  function  getAllMeals($id){
        $meals=Meal::where('sub_category_id',$id)->get();
        return response()->json([
            'data'=>view('admin.sales.meals')->with('meals',$meals)->render()
        ]);
    }
}
