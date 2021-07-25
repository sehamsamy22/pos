<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Imports\MealsImport;
use App\Models\Category;
use App\Models\Meal;
use App\Models\MealProduct;
use App\Models\Product;
use App\Models\Size;
use App\Models\StoreProduct;
use App\Models\SubCategory;
use App\Models\TypeMeal;
use App\Models\Unit;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('admin.products.index', compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $units = Unit::pluck('name', 'id')->toArray();
        return view('admin.products.create', compact('units'))
            ->with('categories', Category::pluck('name', 'id')->toArray())
            ->with('types', TypeMeal::pluck('name', 'id')->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $requests = $request->except('image');
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'photos');
        }
        $product = Product::create($requests);
        $size = Size::create([
            'name' => $request['ar_name'] . '-' . $request['name'],
            'size_price' => $request['size_price'],
            'meal_id' => $product->id
        ]);
        return redirect('dashboard/products')->with('success', 'تم اضافه المنتج  ');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Meal $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::pluck('name', 'id')->toArray();
        $products = Product::all();
        $units = Unit::pluck('name', 'id')->toArray();
        $types = TypeMeal::pluck('name', 'id')->toArray();

        $subcategory = SubCategory::findOrFail($product->sub_category_id);
        $categoryId = $subcategory->category_id;
        return view('admin.products.edit', compact('product', 'categories', 'products', 'categoryId', 'types', 'units'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Meal $meal
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $requests = $request->except('image');
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'photos');
        }
        $product->update($requests);
        return redirect()->route('dashboard.products.index')->with('success', __('تم التعديل'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Meal $meal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect()->route('dashboard.products.index')->with('success', __('تم الحذف بنجاح'));

    }

    public function getAllSubcategories($id)
    {
        $subcategories = SubCategory::where('category_id', $id)->pluck('name', 'id')->toArray();
        return response()->json([
            'status' => true,
            'data' => view('admin.products.subcategories')->with('subcategories', $subcategories)->render()
        ]);
    }

    public function getAjaxProductQty(Request $request)
    {
        $product = Product::find($request->id);
        return response()->json([
            'data' => $product->qty
        ]);
    }

    public function getProduct($id)
    {
        $product = Product::find($id);
        return response()->json([
            'data' => $product->units->name
        ]);
    }

    public function checkquantity(Request $request, $id)
    {
        $meal = Meal::find($id);
        $status = 'ture';

        foreach ($meal->products as $mealproduct) {
            $storeProduct = StoreProduct::where('product_id', $mealproduct->product_id)->first();
            if ($storeProduct->quantity < $request['quantity'] * $mealproduct->quantity) {
                $status = 'false';
            }
        }
        return response()->json([
            'data' => $status,
        ]);
    }

    public function importView()
    {
        return view('admin.products.importView');
    }

    public function importMeal()
    {
        Excel::import(new MealsImport, request()->file('file'));
//        return back();
        return redirect()->route('dashboard.products.index')->with('success', __('تم رقع المنتجات'));

    }

}
