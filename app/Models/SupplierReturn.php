<?php

namespace App\Models;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Model;

class SupplierReturn extends Model
{
    protected $table = 'supplier_returns';

    protected $fillable = ['cause','supplier_id'];

    public function suppliers()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

}
