<?php

namespace App\Observers;

use App\Models\Account;
use App\Models\Supplier;

class SupplierObsever
{



    public  function  created(Supplier $supplier){
        Account::create([
            'name'=>$supplier->name,
            'type'=>'sub',
            // 'status'=>'Creditor',
            'active'=>'1',
            'account_id'=>getsetting('accounting_supplier_id'),
            'supplier_id'=>$supplier->id,
        ]);

    }


}
