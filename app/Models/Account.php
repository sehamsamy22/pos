<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'name', 'code','amount','account_id','active','type','level'
    ];
    public function children()
    {
        return $this->hasMany(Account::class,'account_id');
    }

}
