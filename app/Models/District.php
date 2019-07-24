<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CustomerAddress;
use App\Models\Customer;
use App\Models\Division;

class District extends Model
{
    protected $table = 'districts';

    protected $fillable = ['name', 'division_id','bn_name','lat'.'lon','website'];

    public function customer(){
        return $this->hasMany(CustomerAddress::class, 'district_id');
    }

    public function divisions(){
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function customers(){
        return $this->belongsToMany(Customer::class, 'customer_address')->withPivot('address_type','street','phone');
    }
}
