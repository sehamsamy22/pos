<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitMeasurement extends Model
{
    protected $fillable = [
        'visit_id', 'measurement_id','value'
    ];
    public function visit(){
        return $this->belongsTo(Visit::class,'visit_id');
    }
    public function measurement(){
        return $this->belongsTo(Measurement::class,'measurement_id');
    }

//    public  function  value($id,$date){
//
//      $measurement=VisitMeasurement::where('measurement_id',$id)->where('date',$date)->first();
////      dd($measurement);
//      return $measurement->value;
//    }

public  function lastweight($value){



}

}
