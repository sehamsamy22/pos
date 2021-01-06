<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'user_id', 'supplier_id','date','num','amount','discount','tax','total','payed','reminder'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class,'supplier_id');
    }
    public function items(){
        return $this->hasMany(PurchaseItem::class,'purchase_id');
    }
    public function getInvoiceNumberAttribute()
    {
        return  str_pad($this->id, 6, 0, STR_PAD_LEFT);
    }
}
