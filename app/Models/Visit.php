<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'client_id','date'
    ];
    public function client(){
        return $this->belongsTo(Client::class,'client_id');
    }
    public function measurements(){
        return $this->hasMany(ClientVisit::class,'visit_id');
    }

//    public  function  value($id,$date){
//
//      $measurement=ClientVisit::where('measurement_id',$id)->where('date',$date)->first();
////      dd($measurement);
//      return $measurement->value;
//    }
}
