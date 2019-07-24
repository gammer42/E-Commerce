<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierAlert extends Model
{
    protected $table = 'supplier_alerts';

    protected $dates = ['notification_date','payment_date'];

    protected $fillable = ['amount', 'supplier_id', 'status'];

    public function suppliers(){
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
