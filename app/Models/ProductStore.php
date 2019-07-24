<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StockRequisition;
use App\Models\CurrentStock;
use App\Models\Product;
use App\Models\Store;

class ProductStore extends Model
{
    protected $table = 'product_store';

    protected $fillable = ['store_id','product_id'];

    public function requisitions(){
        return $this->hasMany(StockRequisition::class, 'product_store_id');
    }

    public function stocks(){
        return $this->hasOne(CurrentStock::class, 'product_store_id');
    }

    public function stores(){
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function products(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
