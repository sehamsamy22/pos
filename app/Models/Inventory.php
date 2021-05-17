<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'date','bond_num','description'
    ];
    public function meals()
    {
        return $this->hasMany(InventoryMeal::class, 'inventory_id');
    }
}