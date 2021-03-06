<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class ClientSubscriptions extends Model
{
    protected $fillable = [
        'client_id', 'subscription_id','start','end','total','active',
        'tax','payed','reminder','payment_type'
    ];

    
    public function client(){
        return $this->belongsTo(Client::class,'client_id');
    }
    public function subscription(){
        return $this->belongsTo(Subscription::class,'subscription_id');
    }

    public function meals(){

    }
    


}
