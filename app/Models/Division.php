<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\District;
class Division extends Model
{
    protected $table = 'divisions';

    protected $fillable = ['name', 'bn_name'];

    public function districts(){
        return $this->hasMany(District::class, 'district_id');
    }
}
