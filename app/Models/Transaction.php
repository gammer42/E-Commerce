<?php

namespace App\Models;

use App\Models\Payment;
use App\Models\Store;
use App\Models\User;
use App\Models\Supplier;
use App\Models\Customer;
use App\Models\TransChildCategory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = ['transaction_no','amount','description','date','type','store_id','payment_id','category_id'];

    public function trans_child_cats(){
        return $this->belongsTo(TransChildCategory::class, 'category_id');
    }
    public function stores(){
        return $this->belongsTo(Store::class, 'store_id');
    }
    public function payments(){
        return $this->belongsTo(Payment::class, 'payment_id');
    }
    public function employees(){
        return $this->belongsToMany(User::class, 'employee_transaction', 'transaction_id', 'employee_id');
    }
    public function customers(){
        return $this->belongsToMany(Customer::class, 'customer_transaction', 'transaction_id', 'customer_id');
    }
    public function suppliers(){
        return $this->belongsToMany(Supplier::class, 'supplier_transaction', 'transaction_id', 'supplier_id');
    }
}
