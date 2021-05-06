<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Http\Requests\MealRequest;
use App\Imports\MealsImport;
use App\Models\Category;
use App\Models\Meal;
use App\Models\MealProduct;
use App\Models\Product;
use App\Models\Size;
use App\Models\StoreMeal;
use App\Models\SubCategory;
use App\Models\TypeMeal;
use App\Models\Unit;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
        $units=Unit::pluck('name','id')->toArray();

        return view('admin.meals.create',compact('units'))
        ->with('categories',Category::pluck('name','id')->toArray())
        ->with('types',TypeMeal::pluck('name','id')->toArray())
        ->with('products',Product::all());

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
         if(isset($requests['component_names'])){
        $components= collect($requests['component_names'])->zip(collect($requests['qtys']),collect($requests['avg_cost']));
        $sum=0;
        $size=Size::create([
            'name'=>$request['ar_name'].'-'.$request['name'],
            'size_price'=>$request['size_price'],
            'meal_id'=>$meal->id
        ]);
        foreach($components as $component){
            MealProduct::create([
                'meal_id'=>$meal->id,
                'product_id'=>$component[0],
                'quantity'=>$component[1],
                'avg_cost'=>$component[2],
                'size_id'=>$size->id
            ]);
            $product=Product::find($component[0]);
            $sum+=$product->avg_cost*$component[1];
        }
        $meal->update([
            'approx_price'=>$sum,
        ]);}
        return redirect('dashboard/meals')->with('success', 'تم اضافه الوجبة  ');
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
        $units=Unit::pluck('name','id')->toArray();
        $types=TypeMeal::pluck('name','id')->toArray();

        $subcategory=SubCategory::findOrFail($meal->sub_category_id);
        $categoryId=$subcategory->category_id;
        return view('admin.meals.edit',compact('meal','categories','products','categoryId','types','units'));

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
        if($meal->products){
        foreach ($meal->products as $product){
            $product->delete();
        }
       }
       if(isset($requests['product_id'])){
            $components= collect($requests['component_names'])->zip(collect($requests['qtys']));
            foreach($components as $component){
                MealProduct::create([
                    'meal_id'=>$meal->id,
                    'product_id'=>$component[0],
                    'quantity'=>$component[1],
                ]);
            }
        }

        if(isset($requests['old_product'])){
            $oldproducts= collect($requests['old_product'])->zip(collect($requests['old_product_quantity']));
            foreach($oldproducts as $product){
                MealProduct::create([
                    'meal_id'=>$meal->id,
                    'product_id'=>$product[0],
                    'quantity'=>$product[1],
//                   'avg_cost'=>$product[2],

                ]);
            }
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
            'data'=>$product->units->name
        ]);
    }

    public function checkquantity(Request $request,$id){
        $meal = Meal::find($id);
        $status='ture';

        foreach($meal->products as $mealproduct){
            $storeProduct=StoreMeal::where('product_id',$mealproduct->product_id)->first();
            if($storeProduct->quantity < $request['quantity'] * $mealproduct->quantity ){
                $status='false';
            }
        }
        return response()->json([
            'data'=>$status,
        ]);
    }
    public function importView(){
        return view('admin.meals.importView');
    }

    public function importMeal()
    {
        Excel::import(new MealsImport,request()->file('file'));
//        return back();
        return redirect()->route('dashboard.meals.index')->with('success', __('تم رقع المنتجات'));

    }

}
