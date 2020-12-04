<?php

namespace App\Observers;

use App\Models\Account;
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
                'details'=>' رقم فاتورة مشتريات'.$purchase->num,
                'status'=>'new',
        ]);
        $puchaseAcount=Account::find(getsetting('accounting_purchase_id'));

        $supplierAcount=Account::where('supplier_id',$purchase->supplier_id)->first();
        $cashaccount=Account::find(getsetting('accounting_cash_id'));
        $madaaccount=Account::find(getsetting('accounting_mada_id'));
        $visaaccount=Account::find(getsetting('accounting_visa_id'));
        // $supplierAcount->update([
        //     'amount'=>$supplierAcount->amount+$purchase->total,
        // ]);
        // dd($supplierAcount->amount);
        //من حساب المشتريات
        EntryAccount::create([
            'entry_id'=>$entry->id,
            'account_id'=>$puchaseAcount,
            'affect'=>'debtor',
            'amount'=>$purchase->total,
            'balance'=>$puchaseAcount->balance+$purchase->total,
        ]);
        //الى حساب المورد
        EntryAccount::create([
            'entry_id'=>$entry->id,
            'account_id'=> $supplierAcount->id,
            'affect'=>'creditor',
            'amount'=>$purchase->total,
            'balance'=>$supplierAcount->balance-$purchase->payed,

        ]);
        //الى حساب الخزنة-المدى-الفيزا
        if($purchase->payment_type =='cash'){
            EntryAccount::create([
                'entry_id'=>$entry->id,
                'account_id'=> $cashaccount->id,
                'affect'=>'creditor',
                'amount'=>$purchase->payed,
                'balance'=>$cashaccount->amount-$purchase->payed,

            ]);
            }
            elseif($purchase->payment_type =='mada'){

                EntryAccount::create([
                    'entry_id'=>$entry->id,
                    'account_id'=> $madaaccount->id,
                    'affect'=>'creditor',
                    'amount'=>$purchase->payed,
                    'balance'=>$madaaccount->amount-$purchase->payed,

                ]);
            }elseif($purchase->payment_type =='veza'){
                EntryAccount::create([
                    'entry_id'=>$entry->id,
                    'account_id'=> $visaaccount->id,
                    'affect'=>'creditor',
                    'amount'=>$purchase->payed,
                    'balance'=>$visaaccount->amount-$purchase->payed,
                ]);

            }



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
