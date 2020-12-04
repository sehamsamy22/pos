<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use \Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

    protected $fillable = [
        'name', 'code','amount','account_id','active','type','level','client_id','supplier_id'
    ];
    public function getParentKeyName()
{
    return 'account_id';
}
    public function children()
    {
        return $this->hasMany(Account::class,'account_id');
    }
    public function client(){
        return $this->belongsTo(Client::class,'client_id');
    }
    public function openning_balance($id,$request){

        if ($request->has('from') && $request->has('to') ) {
            $entries_debtor=EntryAccount::where('account_id', $id)
            ->where('created_at','<',$request['from'])->where('affect','debtor')->sum('balance');
            $entries_creditor=EntryAccount::where('account_id', $id)
            ->where('created_at','<',$request['from'])->where('affect','creditor')->sum('balance');
            $sum=$entries_debtor-$entries_creditor;
            return $sum;
        }

    }

    public function debtor_balance($id,$request){

        if ($request->has('from') && $request->has('to') ) {
            $entries_debtor=EntryAccount::where('account_id', $id)->
            whereBetween('created_at',[$request['from'],$request['to']])->
            where('affect','debtor')->sum('balance');
                 return $entries_debtor;
        }else{

        $entries_debtor=EntryAccount::where('account_id', $id)->
        where('affect','debtor')->sum('balance');
             return $entries_debtor;
        }
    }

    public function creditor_balance($id,$request){

        if ($request->has('from') && $request->has('to') ) {
            $entries_creditor=EntryAccount::where('account_id', $id)->
            whereBetween('created_at',[$request['from'],$request['to']])->
            where('affect','creditor')->sum('balance');
                 return $entries_creditor;
        }else{
        $entries_creditor=EntryAccount::where('account_id', $id)->
        where('affect','creditor')->sum('balance');
             return $entries_creditor;
        }
    }


}
