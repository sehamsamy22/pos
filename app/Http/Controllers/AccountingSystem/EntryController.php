<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\AccountLog;
use App\Models\Entry;
use App\Models\EntryAccount;
use App\Traits\Entries\ManualCreateEntry;
use App\Traits\ManualCreateEntry as TraitsManualCreateEntry;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;

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
        $entry =Entry::find($id);
        $accounts=EntryAccount::where('entry_id',$id)->get();
        return view('admin.entries.show', compact('entry','accounts'));

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
        $entry =Entry::find($id);
        $entry->delete();
        return redirect()->route('dashboard.entries.index')->with('success', __('تم الحذف بنجاح'));

    }


    public  function filter(Request $request){
        $requests=request()->all();
// dd($requests['source']);

            if ($requests['from']==null && $requests['to']==null && $request->has('source') && $requests['status']==null) {

                $entries =  Entry::where('source','Like', '%'.$requests['source'].'%')->get();
            }

            elseif ($requests['from']==null && $requests['to']== null && $requests['source']==null && $requests['status']!=null  ) {

                $entries =  Entry::where('status',$requests['status'])->get();
            }
            elseif ($requests['from']==null && $requests['to']== null && $requests['source']!=null && $requests['status']!=null  ) {

                $entries =  Entry::where('source','Like', '%'.$requests['source'].'%')->where('status',$requests['status'])->get();
            }
       else if ($request->has('from') && $request->has('to') && $requests['source']==null && $requests['status']==null) {

            $entries = Entry::whereBetween('created_at', [$request['from'],$request['to']])->get();


        }elseif ($request->has('from') && $request->has('to')&& $request->has('status') && $requests['source']==null ) {
            $entries =  Entry::whereBetween('created_at', [$request['from'],$request['to']])->where('status',$request['status'])->get();

        }
        elseif ($request->has('from') && $request->has('to') && $request->has('source') && $requests['status']==null) {

            $entries =  Entry::whereBetween('created_at', [$request['from'],$request['to']])->where('source','Like', '%'.$requests['source'].'%')->get();
        }
        elseif ($request->has('from') && $request->has('to') && $request->has('source') && $request->has('status')) {

            $entries =  Entry::whereBetween('created_at', [$request['from'],$request['to']])->where('source','Like', '%'.$requests['source'].'%')->where('status' ,$requests['status'])->get();
        }



        else{
            $entries = Entry::all()->reverse();

        }
        // dd($entries);
        return view('admin.entries.index',compact('entries'));

    }

   public function posted($id){
    $entry =Entry::find($id);
    // dd( $entry);
        $entry->update([
            'status'=>'posted',
        ]);

      $entryAccounts=EntryAccount::where('entry_id',$id)->get();
    //   dd($entryAccounts);
     foreach($entryAccounts as $entryaccount){
     $account=Account::find($entryaccount->account_id);
       if($entryaccount->affect=='debtor')
     {
        $account->update([
            'amount'=>$account->amount + $entryaccount->amount
        ]);

     }elseif($entryaccount->affect=='creditor'){
        $account->update([
            'amount'=>$account->amount-$entryaccount->amount
        ]);
     }
    }
     alert()->success('تم  ترحيل القيد اليومى بنجاح !')->autoclose(5000);
      return back();
    }

}
