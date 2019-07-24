<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $table = 'attributes';

    protected $fillable = ['name','value', 'product_id'];

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
