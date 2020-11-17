<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Entry;
use App\Models\EntryAccount;
use App\Traits\Entries\ManualCreateEntry;
use App\Traits\ManualCreateEntry as TraitsManualCreateEntry;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EntryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts=Account::where('type','sub')->get();
        $entries =Entry::all()->reverse();
        return view('admin.entries.index',compact('accounts','entries'))
        ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accounts=Account::where('type','sub')->get();    //  dd($accounts);
        return view('admin.entries.create',compact('accounts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'source'=>'required|string|max:191',
            'date'=>'required',
            'amount'=>'required',
            'type'=>'required',

        ];


        // $this->ManualCreateEntry($request);

        $requests = $request->except('from_account_id','to_account_id');


        $requests['type']='manual';

        $entry=Entry::create($requests);
        $account_id=collect($request['account_id']);
        $debtor=collect($request['debtor']);
        $creditor=collect($request['creditor']);
        $types=[];
        foreach($debtor as $key=>$item){
            if($item==0){
                $types[$key]='creditor';
            }else{
                $types[$key]='debtor';
            }
        }

        $all= $account_id->zip($debtor,$creditor,$types);
        $debtorAccounts=[];
        $creditorAccounts=[];

       foreach($all as $key=>$item){
            if($item[3]=='debtor'){
               $debator= EntryAccount::create([
                    'entry_id'=>$entry->id,
                    'account_id'=>$item['0'],
                    'affect'=>'debtor',
                    'amount'=>$item['1'],
                ]);
               array_push( $debtorAccounts,$debator);
            }
            if($item[3]=='creditor'){
              $creditor = EntryAccount::create([
                    'entry_id'=>$entry->id,
                    'affect'=>'creditor',
                    'account_id'=>$item['0'],
                    'amount'=>$item['2'],
                ]);
                array_push( $creditorAccounts,$creditor);
            }
       }


            alert()->success('تم اضافةالقيد اليومى بنجاح !')->autoclose(5000);
        return redirect()->route('dashboard.entries.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    // public  function filter(Request $request){
    //     $requests=request()->all();

    //     if ($request->has('code')&$request->code!=NULL) {

    //         $entries = AccountingEntry::where('code', $requests['code'])->get();
    //     }elseif ($request->has('date')&$request->date!=NULL) {

    //         $entries = AccountingEntry::where('date', $requests['date'])->get();


    //     }elseif ($request->has('type')&$request->type!=NULL) {
    //                 if($requests['type']=='manual'){
    //         $entries = AccountingEntry::where('type','manual')->get();
    //                 }elseif($requests['type']=='automatic'){
    //          $entries = AccountingEntry::where('type','automatic')->get();
    //                 }
    //     }elseif ($request->has('source')&$request->source!=NULL) {
    //         $entries = AccountingEntry::where('source','Like', '%'.$requests['source'].'%')->get();
    //     }else{
    //         $entries = AccountingEntry::all()->reverse();

    //     }
    //     return $this->toIndex(compact('entries'));


    // }

}
