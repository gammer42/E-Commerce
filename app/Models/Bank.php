<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Account;
use App\Models\Payment;

class Bank extends Model
{
    protected $table = 'banks';

    protected $fillable = ['name','type'];

    public function accounts(){
        return $this->hasMany(Account::class,'bank_id');
    }
    public function payments(){
        return $this->hasMany(Payment::class,'bank_id');
    }
}
