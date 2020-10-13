<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientVisit extends Model
{
    protected $fillable = [
        'client_id', 'date','measurement_id','value'
    ];
    public function client(){
        return $this->belongsTo(Client::class,'client_id');
    }
    public function measurement(){
        return $this->belongsTo(Client::class,'measurement_id');
    }
}
