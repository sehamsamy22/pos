<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'name', 'description','price','duration','num_meals','discount'
    ];
    public function meals(){
        return $this->hasMany(SubscriptionMeal::class,'subscription_id');
    }
}
