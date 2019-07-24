<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Order;

class Card extends Model
{
    protected $table = 'cards';

    protected $fillable = ['name','description'];

    public function orders(){
        return $this->hasMany(Order::class, 'card_id');
    }
}
