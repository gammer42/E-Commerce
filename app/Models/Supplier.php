<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Upazila;
use App\Models\Purchase;
use App\Models\SupplierAlert;
use App\Models\SupplierReturn;
use App\Models\Product;
use App\Models\Transaction;

class Supplier extends Model
{
    protected $table = 'suppliers';

    protected $fillable = ['supplier_code','supplier_name','contact_person','email','phone','store_name',
    'vat_reg_num', 'address','address','description'];

    public function upazilas(){
        return $this->belongsTo(Upazila::class, 'upazila_id');
    }

    public function supplier_alerts(){
        return $this->hasMany(SupplierAlert::class, 'supplier_id');
    }

    public function purchases(){
        return $this->hasMany(Purchase::class, 'supplier_id');
    }

    public function products(){
        return $this->hasMany(Product::class, 'supplier_id');
    }
    public function supplier_returns(){
        return $this->hasMany(SupplierReturn::class, 'supplier_id');
    }
    public function transactions(){
        return $this->belongsToMany(Transaction::class, 'supplier_transaction', 'supplier_id', 'transaction_id');
    }
}
