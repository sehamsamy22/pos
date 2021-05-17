<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\Meal;
use App\Models\MealProduct;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class MealSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $meal=Meal::findOrFail(\request('meal_id'));
        return view('admin.meals.sizes.create')->with('meal',$meal)
            ->with('products',Product::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string',
            'size_price' => 'required|numeric|min:0',
            'meal_id' => 'required|exists:meals,id',
        ]);
        $meal=Meal::find($request['meal_id']);
        $size=Size::create([
            'name'=>$meal->ar_name .'-'.$request['name'],
            'size_price'=>$request['size_price'],
            'meal_id'=>$meal->id
        ]);

        return back()->with('success', __('تم اضافة الحجم للمنتج بنجاح '));


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $meal=Meal::find($id);
        $sizes=Size::where('meal_id',$id)->get();
        return view('admin.meals.sizes.index',compact('meal','sizes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $size=Size::find($id);
        $meal=Meal::find($size->id);
        $products=Product::all();
        return view('admin.meals.sizes.edit',compact('size','meal','products'));
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
        $type=Size::findOrfail($id);
        $type->update($request->all());
        return back()->with('success', __('تم تعديل الحجم للمنتج بنجاح '));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Size::find($id)->delete();
        return back()->with('success', __('تم حذف الحجم للمنتج بنجاح '));

    }
}
