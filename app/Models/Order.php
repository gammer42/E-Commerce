<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Payment;
use App\Models\Account;
use App\Models\SalesPerson;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ['order_no', 'date', 'notes', 'total', 'advance', 'status', 'store_id', 'sales_person_id', 'customer_id'];
    
    public function payments(){
        return $this->belongsToMany(Payment::class, 'order_payment', 'payment_id', 'order_id');
    }

    public function stores(){
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function persons(){
        return $this->belongsTo(SalesPerson::class, 'sales_person_id');
    }

    public function customers(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
