<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;

class CustomerType extends Model
{
    protected $table = 'customer_types';

    protected $fillable = ['type_name','discount','target_sale'];

    public function types(){
        return $this->hasMany(Customer::class, 'type_id');
    }
}
