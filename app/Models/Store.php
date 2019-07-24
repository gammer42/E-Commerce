<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\ProductStore;
use App\Models\Promotion;
use App\Models\Product;
use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;

class Store extends Model
{
    protected $table = 'stores';

    protected $fillable = ['name','email','phone','city','location','address','post_code','vat_no','logo','description'];

    public function users(){
        return $this->hasMany(User::class,'store_id');
    }

    public function product_stores(){
        return $this->hasMany(ProductStore::class,'store_id');
    }

    public function products(){
        return $this->belongsToMany(Product::class, 'product_store');
    }

    public function accounts(){
        return $this->belongsToMany(Account::class, 'account_store', 'store_id', 'account_id');
    }

    public function promotions(){
        return $this->belongsToMany(Promotion::class, 'promotion_store', 'store_id', 'promotion_id');
    }
    public function transactions(){
        return $this->hasMany(Transaction::class,'store_id');
    }
}
