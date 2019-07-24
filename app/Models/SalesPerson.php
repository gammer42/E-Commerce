<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesPerson extends Model
{
    protected $table = 'sales_person';

    protected $fillable = ['type', 'name', 'phone', 'commission', 'balance', 'fk_id'];

}
