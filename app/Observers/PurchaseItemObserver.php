<?php

namespace App\Observers;

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
       $storeProduct=StoreProduct::where('product_id',$purchaseItem->product_id)->first();
       if(isset($storeProduct)){
           $storeProduct->quantity +=$purchaseItem->quantity;
           $storeProduct->update([
            'quantity'=>$storeProduct->quantity
        ]);
       }else{
           StoreProduct::create([
               'product_id'=>$purchaseItem->product_id,
               'quantity'=>$purchaseItem->quantity,
           ]);
       }

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
        $storeProduct=StoreProduct::where('product_id',$purchaseItem->product_id)->first();
        if(isset($storeProduct)){
            if ($storeProduct->quantity > $purchaseItem->quantity) {
                $storeProduct->quantity -= $purchaseItem->quantity;
                $storeProduct->update([
                    'quantity'=>$storeProduct->quantity
                ]);
            }elseif ($storeProduct->quantity = $purchaseItem->quantity){
                $storeProduct->delete();
            }

    }
    }
}
