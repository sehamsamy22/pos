<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'user_id', 'client_id','date','num','amount','discount','total','payed','payment_type','discount_id'
    ];
    public function getInvoiceNumberAttribute()
    {
        return  str_pad($this->id, 6, 0, STR_PAD_LEFT);
    }
    public function discount(){
        return $this->belongsTo(Discount::class,'discount_id');
    }
}
