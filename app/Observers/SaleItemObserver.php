<?php

namespace App\Observers;

use App\Models\ProductLog;
use App\Models\SaleItem;
use App\Models\StoreProduct;

class SaleItemObserver
{
    /**
     * Handle the sale item "created" event.
     *
     * @param  \App\Models\SaleItem  $saleItem
     * @return void
     */
    public function created(SaleItem $saleItem)
    {
        // dd($saleItem->meal->products);
        foreach ($saleItem->meal->products as $mealproduct) {

            $storeProduct = StoreProduct::where('product_id', $mealproduct->product_id)->first();
            if ($storeProduct) {

                if ($storeProduct->quantity - $saleItem->quantity > 0) {

                    $storeProduct->quantity -= $mealproduct->quantity * $saleItem->quantity;

                    $storeProduct->update([
                        'quantity' => $storeProduct->quantity > 0 ? $storeProduct->quantity : 0
                    ]);
                }

                ProductLog::create([
                    'product_id' => $mealproduct->product_id,
                    'bill_id' => $saleItem->sale_id,
                    'operation' => 'sales',
                    'quantity' => $mealproduct->quantity
                ]);
            }


        }

    }

    /**
     * Handle the sale item "updated" event.
     *
     * @param  \App\SaleItem  $saleItem
     * @return void
     */
    public function updated(SaleItem $saleItem)
    {
        //
    }

    /**
     * Handle the sale item "deleted" event.
     *
     * @param  \App\Models\SaleItem  $saleItem
     * @return void
     */
    public function deleted(SaleItem $saleItem)
    {
        //
    }

    /**
     * Handle the sale item "restored" event.
     *
     * @param  \App\SaleItem  $saleItem
     * @return void
     */
    public function restored(SaleItem $saleItem)
    {
        //
    }

    /**
     * Handle the sale item "force deleted" event.
     *
     * @param  \App\SaleItem  $saleItem
     * @return void
     */
    public function forceDeleted(SaleItem $saleItem)
    {
        foreach($saleItem->meal->products() as $mealproduct){

            $storeProduct=StoreProduct::where('product_id',$mealproduct->product_id)->first();
                $storeProduct->quantity +=$mealproduct->quantity*$saleItem->quantity;
                $storeProduct->update([
                    'quantity'=>$storeProduct->quantity
                ]);

        }
    }
}
