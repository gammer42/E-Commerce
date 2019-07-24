<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\MOdels\Customer;

class Phone extends Model
{
    protected $table = 'phones';

    protected $fillable = ['phone','des'];

    public function customers(){
        return $this->belongsToMany(Customer::class, 'customer_phone');
    }
}
