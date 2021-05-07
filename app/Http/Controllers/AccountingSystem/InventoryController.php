<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Area;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Inventory;
use App\Models\InventoryMeal;
use App\Models\Meal;
use App\Models\StoreMeal;
use App\Models\Unit;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventories=Inventory::all();
        return view('admin.inventories.index',compact('inventories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.inventories.create');
    }

    public function store(Request $request)
    {
        $rules=[
            "date" => "required",
            "bond_num" => "required",
            "description" => "required",
            "real_quantity"=> "required|array",
        ];
        $this->validate($request,$rules);
        $requests = $request->all();
      $inventory= Inventory::create([
            "date" => $request['date'],
            "bond_num" => $request['bond_num'],
            "description" =>$request['description'],
        ]);
      foreach ($request['real_quantity'] as $key=>$real){
          InventoryMeal::create([
              'inventory_id'=>$inventory->id,
              'meal_id'=>$key,
              "quantity"=>Meal::find($key)->quantity(),
              "real_quantity"=>$real,
          ]);

          $storeMeal=StoreMeal::where('meal_id',$key)->first();
          $storeMeal->update([
              "quantity"=>$real,
          ]);
      }

        return redirect()->route('dashboard.inventories.index')->with('success', 'تم اضافة الخصم');

    }
    public  function show($id){
        $inventory=Inventory::find($id);
        return view('admin.inventories.show',compact('inventory'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return redirect()->route('dashboard.inventories.index')->with('success', __('تم الحذف بنجاح'));
    }
}
