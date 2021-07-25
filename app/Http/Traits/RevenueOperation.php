<?php

namespace App\Http\Traits;

use App\Models\Account;
use App\Models\ClientSubscriptions;
use App\Models\Entry;
use App\Models\EntryAccount;
use App\Models\Product;
use App\Models\ProductLog;
use App\Models\Revenue;
use App\Models\RevenueProduct;
use App\Models\Sale;
use App\Models\StoreProduct;
use Illuminate\Http\Request;

trait RevenueOperation
{

    /**
     * Update Existing Setting
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function CreateRvenuesubscription(Request $request)
    {
        $cashaccount=Account::find(getsetting('accounting_cash_id'));
        $madaaccount=Account::find(getsetting('accounting_mada_id'));
        $visaaccount=Account::find(getsetting('accounting_visa_id'));
        if($request['type']=='subscription'){
            $clients_subscription=ClientSubscriptions::find($request['client_subscription_id']);
            $clientAccount=Account::where('client_id',$clients_subscription->client_id)->first();

            $clients_subscription->update([
                'payed'=>$clients_subscription->payed+$request['amount'],
                'reminder'=>$clients_subscription->reminder-$request['amount'],
            ]);
           $revenue=Revenue::create([
                'client_subscription_id'=>$request['client_subscription_id'],
                'amount'=>$request['amount'],
                'type'=>'subscription',
                "payment_type" =>$request['payment_type'],
                'date'=>$request['date'],
                'num'=>$request['num'],
            ]);

            if($request['payment_type']=='cash')
                {
                    $entry=Entry::create([
                        'date'=>$revenue->created_at,
                            'source'=>'سند قبض اشتراكات',
                            'type'=>'automatic',
                            'details'=>'سند قبض اشتراكات',
                            'status'=>'new',
                    ]);

                     EntryAccount::create([
                        'entry_id'=>$entry->id,
                        'account_id'=> $clientAccount->id,
                        'affect'=>'debtor',
                        'amount'=>$request['amount'],
                        'balance'=>$clientAccount->amount+$request['amount']
                    ]);
                    EntryAccount::create([
                        'entry_id'=>$entry->id,
                        'account_id'=>$cashaccount,
                        'affect'=>'creditor',
                        'amount'=>$request['amount'],
                        'balance'=>$cashaccount->amount-$request['amount']
                    ]);


                }elseif($request['payment_type']=='mada')
                {
                    $entry=Entry::create([
                        'date'=>$revenue->created_at,
                            'source'=>'سند قبض اشتراكات',
                            'type'=>'automatic',
                            'details'=>'سند قبض اشتراكات',
                            'status'=>'new',
                            'balance'=>$madaaccount->amount-$request['amount']

                    ]);

                     EntryAccount::create([
                        'entry_id'=>$entry->id,
                        'account_id'=>$clientAccount->id,
                        'affect'=>'debtor',
                        'amount'=>$request['amount'],
                        'balance'=>$clientAccount->amount+$request['amount']

                    ]);
                    EntryAccount::create([
                        'entry_id'=>$entry->id,
                        'account_id'=>$madaaccount,
                        'affect'=>'creditor',
                        'amount'=>$request['amount'],
                        'balance'=>$madaaccount->amount-$request['amount']
                    ]);

                }
                elseif($request['payment_type']=='veza')
                {
                    $entry=Entry::create([
                        'date'=>$revenue->created_at,
                            'source'=>'سند قبض اشتراكات',
                            'type'=>'automatic',
                            'details'=>'سند قبض اشتراكات',
                            'status'=>'new',
                    ]);

                     EntryAccount::create([
                        'entry_id'=>$entry->id,
                        'account_id'=> $clientAccount->id,
                        'affect'=>'debtor',
                        'amount'=>$request['amount'],
                        'balance'=>$clientAccount->amount+$request['amount']

                    ]);
                    EntryAccount::create([
                        'entry_id'=>$entry->id,
                        'account_id'=> $visaaccount,
                        'affect'=>'creditor',
                        'amount'=>$request['amount'],
                        'balance'=>$visaaccount->amount-$request['amount']

                    ]);

                }
        }

    }

    public function CreateRvenuesale(Request $request)
    {
        // dd($request->all());
        $sale=Sale::find($request['sale_id']);

        if($sale->client_id == Null){
            $clientAccount=Account::find(getsetting('accounting_cash_client_id'));
        }else{
            $clientAccount=Account::where('client_id',$sale->client_id)->first();
        }
        $cashaccount=Account::find(getsetting('accounting_cash_id'));
        $madaaccount=Account::find(getsetting('accounting_mada_id'));
        $visaaccount=Account::find(getsetting('accounting_visa_id'));
        if($request['type']=='sale'){
            $sale->update([
                'payed'=>$sale->payed+$request['amount'],
            ]);
           $revenue=Revenue::create([
                'sale_id'=>$request['sale_id'],
                'amount'=>$request['amount'],
                'type'=>'sale',
                "payment_type" =>$request['payment_type'],
                'date'=>$request['date'],
                'num'=>$request['num'],
            ]);
            $entry=Entry::create([
                'date'=>$revenue->created_at,
                    'source'=>'سند قبض مبيعات',
                    'type'=>'automatic',
                    'details'=>'سند قبض مبيعات',
                    'status'=>'new',
            ]);
            EntryAccount::create([
                'entry_id'=>$entry->id,
                'account_id'=> $clientAccount->id,
                'affect'=>'debtor',
                'amount'=>$request['amount'],
                'balance'=>$clientAccount->amount-$request['amount']
            ]);
            if($request['payment_type']=='cash')
                {
                    EntryAccount::create([
                        'entry_id'=>$entry->id,
                        'account_id'=>$cashaccount,
                        'affect'=>'creditor',
                        'amount'=>$request['amount'],
                        'balance'=>$cashaccount->amount-$request['amount']
                    ]);

                }elseif($request['payment_type']=='mada')
                {
                    EntryAccount::create([
                        'entry_id'=>$entry->id,
                        'account_id'=>$madaaccount,
                        'affect'=>'creditor',
                        'amount'=>$request['amount'],
                        'balance'=>$madaaccount->amount+$request['amount']
                    ]);
                }
                elseif($request['payment_type']=='veza')
                {
                    EntryAccount::create([
                        'entry_id'=>$entry->id,
                        'account_id'=> $visaaccount,
                        'affect'=>'creditor',
                        'amount'=>$request['amount'],
                        'balance'=>$visaaccount->amount+$request['amount']
                    ]);
                }
        }

    }

    public function CreateRvenueReceipt(Request $request)
    {

        $cashaccount=Account::find(getsetting('accounting_cash_id'));
        $madaaccount=Account::find(getsetting('accounting_mada_id'));
        $visaaccount=Account::find(getsetting('accounting_visa_id'));
        $supplierAccount=Account::where('supplier_id',$request['supplier_id'])->first();

        if($request['type']=='receipt'){

       $revenue=  Revenue::create([
                'supplier_id'=>$request['supplier_id'],
                'amount'=>$request['amount'],
                'type'=>'receipt',
                "payment_type" => $request['payment_type'],
                'date'=>$request['date'],
                'num'=>$request['num'],

            ]);
            $entry=Entry::create([
                'date'=>$revenue->created_at,
                    'source'=>'سند صرف',
                    'type'=>'automatic',
                    'details'=> 'سند صرف رقم  '.$revenue->id,
                    'status'=>'new',
            ]);

            if($request['payment_type']=='cash')
                {
                    //من حساب المشتريات
                    EntryAccount::create([
                        'entry_id'=>$entry->id,
                        'account_id'=>  $cashaccount->id,
                        'affect'=>'debtor',
                        'amount'=>$request['amount'],
                        'balance'=>$cashaccount->balance-$request['amount'],

                    ]);
                        //الى حساب النقدية
                     EntryAccount::create([
                        'entry_id'=>$entry->id,
                        'account_id'=>  $cashaccount->id,
                        'affect'=>'creditor',
                        'amount'=>$request['amount'],
                        'balance'=>$cashaccount->balance-$request['amount'],

                    ]);
                    //الى حساب المورد
                    EntryAccount::create([
                        'entry_id'=>$entry->id,
                        'account_id'=> $supplierAccount->id,
                        'affect'=>'creditor',
                        'amount'=>$request['amount'],
                        'balance'=>$supplierAccount->balance-$request['amount'],
                    ]);

                }
                elseif($request['payment_type']=='mada')
                {
                //من حساب المشتريات
                EntryAccount::create([
                    'entry_id'=>$entry->id,
                    'account_id'=>  $cashaccount->id,
                    'affect'=>'debtor',
                    'amount'=>$request['amount'],
                    'balance'=>$cashaccount->balance-$request['amount'],

                ]);
                                 //الى حساب النقدية
                     EntryAccount::create([
                        'entry_id'=>$entry->id,
                        'account_id'=> $madaaccount->id,
                        'affect'=>'creditor',
                        'amount'=>$request['amount'],
                        'balance'=>$madaaccount->balance-$request['amount'],

                    ]);
                    //الى حساب المورد
                    EntryAccount::create([
                        'entry_id'=>$entry->id,
                        'account_id'=>$supplierAccount->id,
                        'affect'=>'creditor',
                        'amount'=>$request['amount'],
                        'balance'=>$supplierAccount->balance-$request['amount'],

                    ]);

                }

                elseif($request['payment_type']=='veza')
                {


                      //من حساب المشتريات
                EntryAccount::create([
                    'entry_id'=>$entry->id,
                    'account_id'=>  $cashaccount->id,
                    'affect'=>'debtor',
                    'amount'=>$request['amount'],
                    'balance'=>$cashaccount->balance-$request['amount'],

                ]);
                 //الى حساب النقدية
                     EntryAccount::create([
                        'entry_id'=>$entry->id,
                        'account_id'=>$visaaccount->id,
                        'affect'=>'creditor',
                        'amount'=>$request['amount'],
                        'balance'=>$visaaccount->balance-$request['amount'],

                    ]);
                        //الى حساب المورد
                    EntryAccount::create([
                        'entry_id'=>$entry->id,
                        'account_id'=> $supplierAccount->id,
                        'affect'=>'creditor',
                        'amount'=>$request['amount'],
                        'balance'=>$supplierAccount->balance-$request['amount'],

                    ]);

                }
        }

    }

    public function CreateRvenuestoreOut(Request $request)
    {

    $storeAccount=Account::find(getsetting('accounting_store_id'));
    $cashaccount=Account::find(getsetting('accounting_cash_id'));
    $madaaccount=Account::find(getsetting('accounting_mada_id'));
    $visaaccount=Account::find(getsetting('accounting_visa_id'));
        if($request['type']=='out'){
// dd($request->all());
        $revenue=  Revenue::create([

                'amount'=>$request['amount'],
                'type'=>'out',
                // "payment_type" => $request['payment_type'],
                'date'=>$request['date'],
                'num'=>$request['num'],
            'notes'=>$request['notes'],
            ]);

            foreach($request['quantity'] as $product_id=>$quantity )
            {

                $storeProduct=StoreProduct::where('product_id',$product_id)->first();
                if($storeProduct->quantity-$quantity >0){
                    $storeProduct->update([
                        'quantity'=>$storeProduct->quantity -$quantity,
                    ]);
                    // 'product_id', 'operation','bill_id','quantity'
                    ProductLog::create([
                        'product_id'=>$product_id,
                        'operation'=>'اخراج من المخزن',
                        'bill_id'=>$revenue->id,
                        'quantity'=>$quantity
                    ]);
                    RevenueProduct::create([
                        'product_id'=>$product_id,
                        'revenue_id'=>$revenue->id,
                        'quantity'=>$quantity
                    ]);
                }
            }

        }

    }

}
