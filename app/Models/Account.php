<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Payment;
use App\Models\Store;
use App\Models\Order;
use App\Models\DeliveryOrder;
use App\Models\Bank;

class Account extends Model
{
    protected $table = 'accounts';

    protected $fillable = ['uses','type','number', 'name', 
                        'branch','address','type_of_account','transaction_cost',
                        'description','initial_bal','current_bal','bank_id'];

    public function banks(){
        return $this->belongsTo(Bank::class,'bank_id');
    }
   
    public function stores(){
        return $this->belongsToMany(Store::class,'account_store', 'account_id', 'store_id');
    }

    public function orders(){
        return $this->hasMany(DeliveryOrder::class, 'account_id');
    }

    public function payments(){
        return $this->hasMany(Payment::class, 'account_id');
    }
}
