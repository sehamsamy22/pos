<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{


    protected $fillable = [
        'client_subscription_id', 'amount','sale_id','type','date','payment_type',
        'payed','supplier_id','num'
    ];

    public function client_subscription(){
        return $this->belongsTo(ClientSubscriptions::class,'client_subscription_id');
    }


    public function supplier(){
        return $this->belongsTo(Supplier::class,'supplier_id');
    }

}
