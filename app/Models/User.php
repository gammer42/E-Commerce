<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Store;
use App\Models\Stock;
use App\Models\Upazila;
use App\Models\Transaction;
use App\Models\DeliveryPerson;
use App\Traits\HasPermissionsTrait;

class User extends Authenticatable
{
    use Notifiable, HasPermissionsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';

    protected $fillable = ['name','phone','email','address','upazila_id','job_title','dob','blood_group',
    'join_date','salary','nid','img','file','store_id','is_access','password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function upazilas(){
        return $this->belongsTo(Upazila::class,'upazila_id');
    }

    public function stores(){
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function added_by(){
        return $this->hasMany(DeliveryPerson::class, 'added_by');
    }

    public function stocks(){
        return $this->hasMany(Stock::class, 'user_id');
    }
    public function transactions(){
        return $this->belongsToMany(Transaction::class, 'employee_transaction', 'employee_id', 'transaction_id');
    }
}
