<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Store;
use App\Models\Brand;
use App\Models\Category;

class Promotion extends Model
{
    protected $table = 'promotions';

    protected $fillable = ['title', 'type', 'minimum_buy', 'start_from', 'end_to', 'discount_type', 'discount_amount', 'status', '	description'];

    public function stores(){
        return $this->belongsToMany(Store::class, 'promotion_store', 'promotion_id', 'store_id');
    }

    public function brands(){
        return $this->belongsToMany(Brand::class, 'brand_promotion', 'promotion_id', 'brand_id');
    }

    public function categories(){
        return $this->belongsToMany(Category::class, 'category_promotion', 'promotion_id', 'category_id');
    }
}
