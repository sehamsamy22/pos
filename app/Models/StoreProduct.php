<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class StoreProduct extends Model
{
    protected $fillable = [
         'size_id','quantity'
    ];
    public function size(){
        return $this->belongsTo(Size::class,'size_id');
    }


}
