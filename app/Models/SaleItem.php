<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    protected $fillable = [
        'sale_id', 'size_id','quantity','discount','total_price'
    ];
    public function sale(){
        return $this->belongsTo(Sale::class,'sale_id');
    }
    public function size(){
        return $this->belongsTo(Size::class,'size_id');
    }
}

