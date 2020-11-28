<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Entry;
use App\Models\EntryAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts=Account::all();
        $accounts_main=Account::where('type','main')->get();
        return view('admin.accounts.index',compact('accounts','accounts_main'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accounts=Account::whereIn('type',['main','following_main'])->select('id', DB::raw("concat(name,' - ',code) as code_name"))->pluck('code_name','id')->toArray();
        // dd($accounts);
        return view('admin.accounts.create',compact('accounts'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Account::create($request->all());
        return back()->with('success', 'تم اضافه الحساب');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        // dd($account->id);
        $entries=EntryAccount::where('account_id',$account->id)->pluck('entry_id','id')->toArray();

           $acounts_all=EntryAccount::whereIn('entry_id',$entries)->where('account_id','!=',$account->id)->get();

        return view('admin.accounts.show', compact('account','acounts_all'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        $accounts=Account::whereIn('type',['main','following_main'])->select('id', DB::raw("concat(name, ' - ',code) as code_name"))->pluck('code_name','id')->toArray();

        return view('admin.accounts.edit', compact('account','accounts'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        $account->update($request->all());
        return redirect()->route('dashboard.accounts.index')->with('success', __('تم التعديل'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        $account->delete();
        return redirect()->route('dashboard.accounts.index')
        ->with('success', __('تم الحذف بنجاح'));

    }
}
