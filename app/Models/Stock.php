<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PurchaseItem;
use App\Models\Store;
use App\Models\User;
class Stock extends Model
{
    protected $table = 'stocks';

    protected $fillable = ['quantity', 'date', 'buy_price', 'sell_price', 'store_id', 'user_id','purchase_item_id'];

    public function purchaseItems(){
        return $this->belongsTo(PurchaseItem::class, 'purchase_item_id');
    }

    public function stores(){
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
