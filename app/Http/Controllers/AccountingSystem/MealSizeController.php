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

        $product = Product::findOrFail(\request('id'));

        return view('admin.products.sizes.create')->with('product', $product)
            ->with('products', Product::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string',
            'size_price' => 'required|numeric|min:0',
            'product_id' => 'required|exists:products,id',
        ]);
        $product = Product::find($request['product_id']);
        $size = Size::create([
            'name' => $product->ar_name . '-' . $request['name'],
            'size_price' => $request['size_price'],
            'product_id' => $product->id
        ]);

        return back()->with('success', __('تم اضافة الحجم للمنتج بنجاح '));


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $sizes = Size::where('product_id', $id)->get();
        return view('admin.products.sizes.index', compact('product', 'sizes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $size = Size::find($id);
        $product = Product::find($size->product->id);
        $products = Product::all();
        return view('admin.products.sizes.edit', compact('size', 'product', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $size = Size::findOrfail($id);
        $size->update($request->all());
        return redirect()->route('dashboard.sizes.index', [$size->product->id])->with('success', __('تم التعديل'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Size::find($id)->delete();
        return back()->with('success', __('تم حذف الحجم للمنتج بنجاح '));

    }
}
