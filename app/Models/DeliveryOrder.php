<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\DeliveryPerson;
use App\Models\CustomerAddress;
use App\Models\CostConfigure;
use App\Models\Account;

class DeliveryOrder extends Model
{
    protected $table = 'delivery_orders';

    protected $fillable = ['memo_no', 'type', 'ref', 'charge','paid', 'cod', 'range_id', 'person_id', 'account_id', 'customer_address_id'];

    public function persons(){
        return $this->belongsTo(DeliveryPerson::class, 'person_id');
    }

    public function addresses(){
        return $this->belongsTo(CustomerAddress::class, 'customer_address_id');
    }

    public function ranges(){
        return $this->belongsTo(CostConfigure::class, 'range_id'); 
    }

    public function accounts(){
        return $this->belongsTo(Account::class, 'account_id');
    }

}
