<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Meal;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SubCategory;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }

    public  function  getAllSubcategories($id){
        $subcategories=SubCategory::where('category_id',$id)->get();
        return response()->json([
            'status'=>true,
            'data'=>view('admin.sales.subcategories')->with('subcategories',$subcategories)->render()
        ]);
    }

    public  function  getAllMeals($id){
        $meals=Meal::where('sub_category_id',$id)->get();
        return response()->json([
            'data'=>view('admin.sales.meals')->with('meals',$meals)->render()
        ]);
    }
}
