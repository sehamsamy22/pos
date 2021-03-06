<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Discount;
use App\Models\Meal;
use App\Models\Product;
use App\Models\Revenue;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Size;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('from') && $request->has('to')) {

            $sales = Sale::whereBetween('created_at', [$request['from'], $request['to']])->get()->reverse();

        } else {
            $sales = Sale::whereDate('created_at', Carbon::today())->get()->reverse();
        }

        return view('admin.sales.index', compact('sales'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::pluck('name', 'id')->toArray();
        $products = Product::all();
        $categories = Category::all();
        $salelast = Sale::latest()->first();
        $discounts = Discount::all();
        return view('admin.sales.create', compact('clients', 'products', 'discounts', 'categories', 'salelast'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sale = Sale::create([
            'user_id' => Auth::id(),
            'client_id' => $request['client_id'],
            'date' => $request['date'],
            'num' => $request['num'],
            'amount' => $request['amount'],
            'discount' => $request['discount'],
            'total' => $request['total'],
            'payed' => $request['payed'],
            'payment_type' => $request['payment_type'],
            'discount_id' => $request['discount_id'],

        ]);
        $sizes = collect($request['size_id']);
        $qtys = collect($request['quantity']);
        $prices = collect($request['prices']);
        $items = $sizes->zip($qtys, $prices);
        foreach ($items as $item) {
            SaleItem::create([
                'sale_id' => $sale->id,
                'size_id' => $item[0],
                'quantity' => $item[1],
                'total_price' => $item[1] * $item[2],
            ]);
        }

        Revenue::create([
            'sale_id' => $sale->id,
            'amount' => $request['amount'],
            'type' => 'sale',
            "payment_type" => $request['payment_type'],
            'date' => $request['date'],
        ]);

        alert()->success('???? ?????????? ?????????? !')->autoclose(5000);
        return back()->with('sale_id', $sale->id);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        $items = SaleItem::where('sale_id', $sale->id)->get();
        return view('admin.sales.show', compact('sale', 'items'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();
        return redirect()->route('dashboard.sales.index')->with('success', __('???? ?????????? ??????????'));

    }

    public function getAllSubcategories($id)
    {
        $subcategories = SubCategory::where('category_id', $id)->get();
        return response()->json([
            'status' => true,
            'data' => view('admin.sales.subcategories')->with('subcategories', $subcategories)->render()
        ]);
    }

    public function getAllcategories()
    {
        $categories = Category::all();
        return response()->json([
            'status' => true,
            'data' => view('admin.sales.categories')->with('categories', $categories)->render()
        ]);
    }


    public function getAllMeals($id)
    {
        $products = Product::where('sub_category_id', $id)->get();
        return response()->json([
            'data' => view('admin.sales.products')->with('products', $products)->render()
        ]);
    }

    public function getAllsizes($id)
    {
        $sizes = Size::where('product_id', $id)->get();
        return response()->json([
            'data' => view('admin.sales.sizes')->with('sizes', $sizes)->render()
        ]);
    }

    public  function barcode_search($q){
        $size = Size::where('barcode', $q)->first();
        return response()->json([
            'success' => true,
            'data'=>  $size
        ]);
    }
}
