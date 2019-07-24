<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PurchaseItem;
use App\Models\Supplier;

class Purchase extends Model
{
    protected $table = 'purchases';
    
    protected $fillable = ['invoice_no','memo', 'date', 'price', 'supplier_id'];

    public function purchaseItems(){
        return $this->hasMany(PurchaseItem::class, 'purchase_id');
    }

    public function suppliers(){
        return $this->belongsTo(Supplier::class,'supplier_id');
    }
}
