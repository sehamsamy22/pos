<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryProduct extends Model
{
    protected $fillable = [
        'inventory_id','size_id','quantity','real_quantity'
    ];
    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }
}
