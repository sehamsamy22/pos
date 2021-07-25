<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'date','bond_num','description'
    ];
    public function sizes()
    {
        return $this->hasMany(InventoryProduct::class, 'inventory_id');
    }
}
