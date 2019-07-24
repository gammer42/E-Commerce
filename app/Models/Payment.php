<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Bank;
use App\Models\Card;
use App\Models\Account;
use App\Models\Transaction;
use App\Models\Order;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = ['type', 'bank_name', 'payment_method', 'reff_transaction_no', 'customer_account_no', 'customer_card_no', 'card_id', 'bank_id', 'account_id'];

    public function banks(){
        return $this->belongsTo(Bank::class, 'bank_id');
    }

    public function cards(){
        return $this->belongsTo(Card::class, 'card_id');
    }

    public function accounts(){
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function orders(){
        return $this->belongsToMany(Order::class, 'order_payment', 'order_id', 'payment_id');
    }
    public function transactions(){
        return $this->hasMany(Transaction::class, 'payment_id');
    }
}
