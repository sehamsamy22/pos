<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntryAccount extends Model
{

    protected $fillable = [
        'entry_id', 'account_id','affect','amount'
    ];

    protected $table='entries_accounts';


    public function accounts()
    {
        return $this->hasMany(EntryAccount::class,'entry_id');
    }
    public function accounts_debtor()
    {
        $accounts_debtor=EntryAccount::where('entry_id',$this->id)->where('affect','debtor')->get();
        return $accounts_debtor;
    }

    public function accounts_creditor()
    {
        $accounts_creditor=EntryAccount::where('entry_id',$this)->where('affect','creditor')->get();
        return $accounts_creditor;
    }

}
