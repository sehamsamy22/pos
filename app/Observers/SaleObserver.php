<?php

namespace App\Observers;

use App\Models\Entry;
use App\Models\EntryAccount;
use App\Models\Sale as ModelsSale;
use App\Sale;

class SaleObserver
{
    /**
     * Handle the sale "created" event.
     *
     * @param  \App\Sale  $sale
     * @return void
     */
    public function created(ModelsSale $sale)
    {

       

            $entry=Entry::create([
                'date'=>$sale->created_at,
                    'source'=>' مبيعات',
                    'type'=>'automatic',
                    'details'=>'فاتورة بيع رقم'.$sale->num,
                    'status'=>'new',
            ]);

             EntryAccount::create([
                'entry_id'=>$entry->id,
                'account_id'=>$sale->client_id ?? getsetting('accounting_cash_client_id'),
                'affect'=>'debtor',
                'amount'=>$sale->payed,
            ]);
            if($sale->payment_type =='cash'){
            EntryAccount::create([
                'entry_id'=>$entry->id,
                'account_id'=> getsetting('accounting_cash_id'),
                'affect'=>'creditor',
                'amount'=>$sale->payed,
            ]);
            }
            elseif($sale->payment_type =='mada'){

                EntryAccount::create([
                    'entry_id'=>$entry->id,
                    'account_id'=> getsetting('accounting_mada_id'),
                    'affect'=>'creditor',
                    'amount'=>$sale->payed,
                ]);
            }elseif($sale->payment_type =='veza'){
                EntryAccount::create([
                    'entry_id'=>$entry->id,
                    'account_id'=> getsetting('accounting_visa_id'),
                    'affect'=>'creditor',
                    'amount'=>$sale->payed,
                ]);

            }
            EntryAccount::create([
                'entry_id'=>$entry->id,
                'account_id'=> getsetting('accounting_discount_sale_id'),
                'affect'=>'creditor',
                'amount'=>$sale->discount,
            ]);




    }

}
