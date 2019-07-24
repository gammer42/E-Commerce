<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\CustomerType;
use App\Models\CustomerAddress;
use App\Models\District;
use App\Models\Phone;
use App\Models\Transaction;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = ['name','phone','email','membership_id','dob','gender',
    'marital_status','anniversary_date','advanced_amount','img','earned_point','description','type_id'];

    public function types(){
        return $this->belongsTo(CustomerType::class, 'type_id');
    }

    public function addresses(){
        return $this->belongsToMany(District::class, 'customer_address')->withPivot('address_type','street','phone');
    }

    public function address(){
        return $this->hasMany(CustomerAddress::class, 'customer_id');
    }
    public function phones(){
        return $this->belongsToMany(Phone::class, 'customer_phone');
    }
    public function transactions(){
        return $this->belongsToMany(Transaction::class, 'customer_transaction', 'customer_id', 'transaction_id');
    }

}
