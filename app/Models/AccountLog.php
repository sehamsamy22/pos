<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountLog extends Model
{
    protected $table='accounts_logs';

    protected $fillable = [
        'entry_id','account_id','account_amount_before','amount','another_account_id','affect','account_amount_after'
    ];
    public function acount()
    {
        return $this->belongsTo(Account::class,'account_id');
    }


}
