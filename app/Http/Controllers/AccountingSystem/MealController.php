<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Http\Requests\MealRequest;
use App\Models\Category;
use App\Models\Meal;
use App\Models\MealProduct;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meals=Meal::all();

        return view('admin.meals.index',compact('meals'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.meals.create')->with('categories',Category::pluck('name','id')->toArray())->with('products',Product::all());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MealRequest $request)
    {

        $requests = $request->except('image');

        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'photos');
        }
         $meal=Meal::create($requests);
        $components= collect($requests['component_names'])->zip(collect($requests['qtys']));
        $sum=0;

        foreach($components as $component){
            MealProduct::create([
                'meal_id'=>$meal->id,
                'product_id'=>$component[0],
                'quantity'=>$component[1],
            ]);
            $product=Product::find($component[0]);
            $sum+=$product->price*$component[1];
        }

        $meal->update([
            'approx_price'=>$sum,
        ]);
        return back()->with('success', 'تم اضافه الوجبة  ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function show(Meal $meal)
    {
        return view('admin.meals.show',compact('meal'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function edit(Meal $meal)
    {
        $categories=Category::pluck('name','id')->toArray();
        $products=Product::all();
        $subcategory=SubCategory::find($meal->sub_category_id);
        $categoryId=$subcategory->category_id;
        return view('admin.meals.edit',compact('meal','categories','products','categoryId'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function update(MealRequest $request, Meal $meal)
    {
        $requests = $request->except('image');
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'photos');
        }
        $meal->update($requests);
        foreach ($meal->products as $product){
            $product->delete();
        }
        $components= collect($requests['products'])->zip(collect($requests['qtys']));
        foreach($components as $component){
            MealProduct::create([
                'meal_id'=>$meal->id,
                'product_id'=>$component[0],
                'quantity'=>$component[1],
            ]);
        }
        return redirect()->route('dashboard.meals.index')->with('success', __('تم التعديل'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Meal::find($id)->delete();
        return redirect()->route('dashboard.meals.index')->with('success', __('تم الحذف بنجاح'));

    }
    public function delete_product(Request $request)
    {

        MealProduct::find($request['id'])->delete();
        return response()->json([
            'success'=>'تم الحذف بنجاح'
        ]);
    }
    public  function  getAllSubcategories($id){
        $subcategories=SubCategory::where('category_id',$id)->pluck('name','id')->toArray();
        return response()->json([
            'status'=>true,
            'data'=>view('admin.meals.subcategories')->with('subcategories',$subcategories)->render()
        ]);
    }
    public function getAjaxProductQty(Request $request){
        $product = Product::find($request->id);
        return response()->json([
            'data'=>$product->qty
        ]);
    }

    public function getProduct($id){
        $product = Product::find($id);
        return response()->json([
            'data'=>$product->unit
        ]);
    }
}
