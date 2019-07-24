<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CostConfigure;
use App\Models\DeliveryPerson;

class DeliveryCost extends Model
{
    protected $table = 'delivery_costs';

    protected $fillable = ['cost_name', 'delivery_person'];

    public function persons(){
        return $this->belongsTo(DeliveryPerson::class, 'delivery_person');
    }

    public function ranges(){
        return $this->hasMany(CostConfigure::class, 'delivery_cost_id');
    }
}
