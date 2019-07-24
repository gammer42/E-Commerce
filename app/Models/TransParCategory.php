<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\TransChildCategory;

class TransParCategory extends Model
{
    protected $table = 'trans_parent_categories';

    protected $fillable = ['type','name'];

    public function childs(){
        return $this->hasMany(TransChildCategory::class,'categories');
    }
}
