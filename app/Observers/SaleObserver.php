<?php

namespace App\Observers;

use App\Models\Account;
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


        // $puchaseAcount=Account::find(getsetting('accounting_purchase_id'));
        if($sale->client_id == Null){
            $clientAcount=Account::find(getsetting('accounting_cash_client_id'));

        }else{

            $clientAcount=Account::where('client_id',$sale->client_id)->first();
        }
        // dd($clientAcount);
        $cashaccount=Account::find(getsetting('accounting_cash_id'));
        $madaaccount=Account::find(getsetting('accounting_mada_id'));
        $visaaccount=Account::find(getsetting('accounting_visa_id'));
        $saleaccount=Account::find(getsetting('accounting_sale_id'));

            $entry=Entry::create([
                'date'=>$sale->created_at,
                    'source'=>' مبيعات',
                    'type'=>'automatic',
                    'details'=>'فاتورة بيع رقم'. $sale->num,
                    'status'=>'new',
            ]);
                //من حساب  العميل
             EntryAccount::create([
                'entry_id'=>$entry->id,
                'account_id'=>$clientAcount->id,
                'affect'=>'creditor',
                'amount'=>$sale->payed,
                'balance'=>$clientAcount->amount-$sale->payed,
            ]);
            //الى حساب  المبيعات
            EntryAccount::create([
                'entry_id'=>$entry->id,
                'account_id'=> $saleaccount->id,
                'affect'=>'creditor',
                'amount'=>$sale->payed,
                'balance'=>$saleaccount->amount+$sale->total,
            ]);
     //الى حساب  الدفع
            if($sale->payment_type =='cash'){
            EntryAccount::create([
                'entry_id'=>$entry->id,
                'account_id'=> $cashaccount->id,
                'affect'=>'creditor',
                'amount'=>$sale->payed,
                'balance'=>$cashaccount->amount-$sale->payed,

            ]);
            }
            elseif($sale->payment_type =='mada'){

                EntryAccount::create([
                    'entry_id'=>$entry->id,
                    'account_id'=> $madaaccount->id,
                    'affect'=>'creditor',
                    'amount'=>$sale->payed,
                    'balance'=>$madaaccount->amount-$sale->payed,

                ]);
            }elseif($sale->payment_type =='veza'){
                EntryAccount::create([
                    'entry_id'=>$entry->id,
                    'account_id'=> $visaaccount->id,
                    'affect'=>'creditor',
                    'amount'=>$sale->payed,
                    'balance'=>$visaaccount->amount-$sale->payed,
                ]);

            }
            // EntryAccount::create([
            //     'entry_id'=>$entry->id,
            //     'account_id'=> getsetting('accounting_discount_sale_id'),
            //     'affect'=>'creditor',
            //     'amount'=>$sale->discount,

            // ]);




    }

}
