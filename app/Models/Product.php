<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\ProductStore;
use App\Models\Attribute;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Store;
use App\Models\Brand;
use App\Models\Unit;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['product_code', 'name', 'buy_price', 'sell_price', 'is_vatable', 'min_stock', 'img', 'subcategory_id', 'brand_id', 'unit_id', 'supplier_id', 'description'];

    public function brands()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function units()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'subcategory_id');
    }

    public function attributes()
    {
        return $this->hasMany(Attribute::class, 'product_id');
    }

    public function suppliers(){
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function product_stores(){
        return $this->hasMany(ProductStore::class, 'product_id');
    }

    public function stores(){
        return $this->belongsToMany(Store::class, 'product_store');
    }
   
}
