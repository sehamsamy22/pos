<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientVisit extends Model
{
    protected $fillable = [
        'client_id', 'date','measurement_id','value'
    ];
}
