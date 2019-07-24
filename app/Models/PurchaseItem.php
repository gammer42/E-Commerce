<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Purchase;
use App\Models\Product;

class PurchaseItem extends Model
{
    protected $table = 'purchase_item';

    protected $fillable = ['quantity','price','purchase_id','product_id'];

    public function purchases(){
        return $this->belongsTo(Purchase::class,'purchase_id');
    }

    public function products(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
