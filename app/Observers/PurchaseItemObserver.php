<?php

namespace App\Observers;

use App\Models\ProductLog;
use App\Models\PurchaseItem;
use App\Models\StoreProduct;

class PurchaseItemObserver
{
    /**
     * Handle the purchase item "created" event.
     *
     * @param  \App\Models\PurchaseItem  $purchaseItem
     * @return void
     */
    public function created(PurchaseItem $purchaseItem)
    {
       $storeMeal=StoreProduct::where('meal_id',$purchaseItem->meal_id)->first();
       if(isset($storeMeal)){
           $storeMeal->quantity +=$purchaseItem->quantity;
           $storeMeal->update([
            'quantity'=>$storeMeal->quantity
        ]);
       }else{
           StoreProduct::create([
               'meal_id'=>$purchaseItem->meal_id,
               'quantity'=>$purchaseItem->quantity,
           ]);
       }

//       ProductLog::create([
//        'product_id'=>$purchaseItem->meal_id,
//        'bill_id'=>$purchaseItem->purchase_id,
//        'operation'=>'purchases',
//        'quantity'=>$purchaseItem->quantity
//       ]);
    }

    /**
     * Handle the purchase item "updated" event.
     *
     * @param  \App\Models\PurchaseItem  $purchaseItem
     * @return void
     */
    public function updated(PurchaseItem $purchaseItem)
    {
        //
    }

    /**
     * Handle the purchase item "deleted" event.
     *
     * @param  \App\PurchaseItem  $purchaseItem
     * @return void
     */
    public function deleted(PurchaseItem $purchaseItem)
    {
        //
    }

    /**
     * Handle the purchase item "restored" event.
     *
     * @param  \App\PurchaseItem  $purchaseItem
     * @return void
     */
    public function restored(PurchaseItem $purchaseItem)
    {
        //
    }

    /**
     * Handle the purchase item "force deleted" event.
     *
     * @param  \App\Models\PurchaseItem  $purchaseItem
     * @return void
     */
    public function forceDeleted(PurchaseItem $purchaseItem)
    {
        $storeMeal=StoreProduct::where('meal_id',$purchaseItem->meal_id)->first();
        if(isset($storeMeal)){
            if ($storeMeal->quantity > $purchaseItem->quantity) {
                $storeMeal->quantity -= $purchaseItem->quantity;
                $storeMeal->update([
                    'quantity'=>$storeMeal->quantity
                ]);
            }elseif ($storeMeal->quantity = $purchaseItem->quantity){
                $storeMeal->delete();
            }

    }
    }
}
