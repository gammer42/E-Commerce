<?php

namespace App\Models;

use App\Models\Supplier;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;

class Upazila extends Model
{
    protected $table = 'upazilas';

    protected $fillable = ['name', 'district_id','bn_name'];

    public function suppliers(){
        return $this->hasMany(Supplier::class, 'upazila_id');
    }

    public function customer(){
        return $this->hasMany(Customer::class, 'upazila_id');
    }

    public function users(){
        return $this->hasMany(User::class, 'upazila_id');
    }
}
