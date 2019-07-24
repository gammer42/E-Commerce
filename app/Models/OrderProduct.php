<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Order;

class OrderProduct extends Model
{
    protected $table = 'order_products';

    protected $fillable = ['p_name','p_code', 'quantity', 'unit_price', 'discount', 'vat', 'total', 'order_id'];

    public function orders(){
        return $this->belongsTo(Order::class, 'order_id');
    }

}
