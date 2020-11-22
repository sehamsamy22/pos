<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'name', 'code','amount','account_id','active','type','level','client_id'
    ];
    public function children()
    {
        return $this->hasMany(Account::class,'account_id');
    }
    public function client(){
        return $this->belongsTo(Client::class,'client_id');
    }

}
