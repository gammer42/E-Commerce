<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductStore;

class CurrentStock extends Model
{
    protected $table = 'current_stocks';

    protected $fillable = ['quantity', 'buy_price', 'sell_price', 'product_store_id'];

    public function product_stores(){
        return $this->belongsTo(ProductStore::class, 'product_store_id');
    }
}
