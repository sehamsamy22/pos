<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\EntryAccount;
use Illuminate\Http\Request;

class BalanceController extends Controller
{

    public function trial_balance(Request $request){

        $accounts=Account::all();
        return view('admin.accounts.trial_balance',compact('accounts','request'));
    }

}
