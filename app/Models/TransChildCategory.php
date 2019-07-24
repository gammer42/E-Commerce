<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Transaction;
use App\Models\TransParCategory;

class TransChildCategory extends Model
{
    protected $table = 'trans_child_categories';

    protected $fillable = ['name','categories'];

    public function parents(){
        return $this->belongsTo(TransParCategory::class, 'categories');
    }
    public function transactions(){
        return $this->hasMany(Transaction::class, 'category_id');
    }
}
