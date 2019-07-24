<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Category;
use App\Models\Promotion;
use App\Models\Product;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['name','parent_id', 'description'];

    public function parent(){
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }
    public function children(){
        return $this->hasMany(Category::class, 'parent_id')->orderBy('name','asc');
    }

    public function promotions(){
        return $this->belongsToMany(Promotion::class, 'category_promotion', 'promotion_id', 'category_id');
    }

    public function products(){
        return $this->belongsTo(Product::class, 'subcategory_id');
    }
}