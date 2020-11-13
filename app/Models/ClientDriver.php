<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ClientDriver extends Model
{
    protected $fillable = [
        'date', 'client_id','user_id'
    ];

 protected $table='clients_drivers';
    public function client(){
        return $this->belongsTo(Client::class,'client_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
