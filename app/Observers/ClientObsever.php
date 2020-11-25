<?php

namespace App\Observers;

use App\Models\Account;
use App\Models\Client;

class ClientObsever
{



    public  function  created(Client $client){
        Account::create([
            'name'=>$client->name,
            'type'=>'sub',
            // 'status'=>'debtor',
            'active'=>'1',
            'account_id'=>getsetting('accounting_client_id'),
            'client_id'=>$client->id,
        ]);

    }


}
