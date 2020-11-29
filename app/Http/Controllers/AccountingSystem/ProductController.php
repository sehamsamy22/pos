<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\StoreProduct;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::all();
        $categories=Category::pluck('name','id')->toArray();
        return view('admin.products.index',compact('products','categories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::pluck('name','id')->toArray();

        return view('admin.products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $requests = $request->except('image');

        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'photos');
        }
        $product=Product::create($requests);
        return redirect()->route('dashboard.products.index')->with('success', 'تم اضافه صنف  جديد');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {

        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories=Category::pluck('name','id')->toArray();
        $subcategory=SubCategory::find($product->sub_category_id);
        $categoryId=$subcategory->category_id;
        return view('admin.products.edit', compact('product','categories','categoryId'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $rules=[

            "ar_name" => "required|string|min:1|max:255",
           "en_name" => "required|string|min:1|max:255",
           "unit" => "required|string|min:1|max:255",
           'image' => 'sometimes|file|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
           "price" => "required",
           "barcode" => "required|unique:products,barcode,". $product->id

        ];
        $message= [
            'ar_name.required'=>"الإسم باللغه العربية مطلوب",
           'en_name.required'=>"الإسم باللغه الانجليزية مطلوب",
           'unit.required'=>"الوحدة مطلوبة",
           'image.required'=>"صورة الصنف مطلوبة",
           'price.required'=>"سعر الصنف مطلوب",
           'barcode.required'=>"باركود الصنف مطلوب",
           'barcode.unique'=>"باركود الصنف موجود مسبقا",

         ];

        $this->validate($request,$rules,$message);

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
     * @param  \App\Models\Product  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect()->route('dashboard.categories.index')->with('success', __('تم الحذف بنجاح'));

    }
}
