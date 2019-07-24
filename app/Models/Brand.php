<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Product;
use App\Models\Promotion;
class Brand extends Model
{
    protected $table = 'brands';
    
    protected $fillable = ['name','logo','description'];

    public function promotions(){
        return $this->belongsToMany(Promotion::class, 'brand_promotion', 'promotion_id', 'brand_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }

}
