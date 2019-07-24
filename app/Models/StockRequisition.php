<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductStore;

class StockRequisition extends Model
{
    protected $table = 'stock_requisitions';

    protected $fillable = ['quantity','product_store_id'];

    public function product_stores(){
        return $this->belongsTo(ProductStore::class, 'product_store_id');
    }
}
