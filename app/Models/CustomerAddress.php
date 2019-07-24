<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\DeliveryOrder;
use App\Models\District;
use App\Models\Customer;

class CustomerAddress extends Model
{
    protected $table = 'customer_address';

    protected $fillable = ['address_type','street', 'customer_id', 'district_id'];

    public function customers()
    {
        return $this->hasMany(Customer::class, 'customer_id');
    }
    public function districts(){
        return $this->belongsTo(District::class, 'district_id');
    }
    public function orders(){
        return $this->hasMany(DeliveryOrder::class, 'customer_address_id');
    }
}
