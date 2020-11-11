<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\StoreProduct;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $storeproducts=StoreProduct::all();

        return view('admin.stores.index',compact('storeproducts'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function purchase_order(){
        $storeproducts=StoreProduct::all();
        return view('admin.stores.purchase_order',compact('storeproducts'));

    }
}
