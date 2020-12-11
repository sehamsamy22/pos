<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name', 'code','phone','email','address','area_id'
    ];
    public  function area(){
        return $this->belongsTo(Area::class,'area_id');

    }
}
