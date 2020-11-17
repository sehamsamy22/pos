<?php

namespace App\Observers;

use App\Models\Account;

class AccountObserver
{
    public function creating(Account $account)
    {

        if ($account->type=='main'){
            $lastMainAcount = Account::where('type', 'main')->latest()->first();
            if (!is_null($lastMainAcount)) {

                $account->code = $lastMainAcount->code + 1;
                $account->level = $lastMainAcount->level ;

            } else {
                $account->code = 1;
                $account->level = 1;

            }


        }elseif($account->type=='following_main'){

           $perantAccount= Account::find($account->account_id);
            $lastfollowingAcount = Account::where('type','following_main')->where('account_id',$account->account_id)->latest()->first();

           if (!is_null($lastfollowingAcount)) {
               $account->code = $lastfollowingAcount->code + 1;
               $account->level = $lastfollowingAcount->level;

           }else{
               $account->code = $perantAccount->code . 1;
               $account->level = $perantAccount->level +1;

           }
        }
        elseif($account->type=='sub'){

            $perantAccount = Account::find($account->account_id);
            $lastsubAcount = Account::where('type','sub')->where('account_id',$account->account_id)->latest()->first();

            if (!is_null($lastsubAcount)) {

                $account->code = $lastsubAcount->code + 1;
                $account->level = $lastsubAcount->level;

            }else{
              
                $account->code = $perantAccount->code . "000" . 1;
                $account->level = $perantAccount->level + 1 ;

            }

        }
    }
}
