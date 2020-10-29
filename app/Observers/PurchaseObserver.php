<?php

namespace App\Observers;

use App\Models\Purchase;

class PurchaseObserver
{
    /**
     * Handle the purchase "created" event.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return void
     */
    public function created(\App\Models\Purchase $purchase)
    {

    }

    /**
     * Handle the purchase "updated" event.
     *
     * @param  \App\Purchase  $purchase
     * @return void
     */
    public function updated(Purchase $purchase)
    {
        //
    }

    /**
     * Handle the purchase "deleted" event.
     *
     * @param  \App\Purchase  $purchase
     * @return void
     */
    public function deleted(Purchase $purchase)
    {
        //
    }

    /**
     * Handle the purchase "restored" event.
     *
     * @param  \App\Purchase  $purchase
     * @return void
     */
    public function restored(Purchase $purchase)
    {
        //
    }

    /**
     * Handle the purchase "force deleted" event.
     *
     * @param  \App\Purchase  $purchase
     * @return void
     */
    public function forceDeleted(Purchase $purchase)
    {
        //
    }
}
