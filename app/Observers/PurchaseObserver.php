<?php

namespace App\Observers;

use App\Models\Entry;
use App\Models\EntryAccount;
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

        $entry=Entry::create([
            'date'=>$purchase->created_at,
                'source'=>'فاتورة مشتريات',
                'type'=>'automatic',
                'details'=>'فاتورة مشتريات',
                'status'=>'new',
        ]);

         EntryAccount::create([
            'entry_id'=>$entry->id,
            'account_id'=>getsetting('accounting_purchase_id'),
            'affect'=>'debtor',
            'amount'=>$purchase->total,
        ]);
        EntryAccount::create([
            'entry_id'=>$entry->id,
            'account_id'=> $purchase->supplier_id,
            'affect'=>'creditor',
            'amount'=>$purchase->total,
        ]);



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
