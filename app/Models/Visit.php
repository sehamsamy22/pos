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
        return $this->hasMany(VisitMeasurement::class,'visit_id');
    }

}
