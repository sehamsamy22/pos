<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $fillable = [
        'date', 'source','type','status','code','details'
    ];

    public function entry()
    {
        return $this->belongsTo(Entry::class,'entry_id');
    }

    public function accounts()
    {
        return $this->hasMany(EntryAccount::class,'entry_id');
    }


}
