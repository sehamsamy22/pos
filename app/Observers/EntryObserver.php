<?php

namespace App\Observers;

use App\Models\Entry;

class EntryObserver
{

    public function creating(Entry $entry)
    {
                $exiss =Entry::latest()->first();
                if (!is_null($exiss)) {
                    $entry->code =$exiss->code + 1;
                } else {
                    $entry->code = 1000;
                }
    }

    
   public  function  created(Entry $entry){

    // dd( $entry->accounts_debtor());

   }
//
//    public  function  updated(AccountingEntry $entry){
//
//
//    }

}
