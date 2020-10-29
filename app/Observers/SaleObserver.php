<?php

namespace App\Observers;

use App\Sale;

class SaleObserver
{
    /**
     * Handle the sale "created" event.
     *
     * @param  \App\Sale  $sale
     * @return void
     */
    public function created(Sale $sale)
    {
        //
    }

    /**
     * Handle the sale "updated" event.
     *
     * @param  \App\Sale  $sale
     * @return void
     */
    public function updated(Sale $sale)
    {
        //
    }

    /**
     * Handle the sale "deleted" event.
     *
     * @param  \App\Sale  $sale
     * @return void
     */
    public function deleted(Sale $sale)
    {
        //
    }

    /**
     * Handle the sale "restored" event.
     *
     * @param  \App\Sale  $sale
     * @return void
     */
    public function restored(Sale $sale)
    {
        //
    }

    /**
     * Handle the sale "force deleted" event.
     *
     * @param  \App\Sale  $sale
     * @return void
     */
    public function forceDeleted(Sale $sale)
    {
        //
    }
}
