<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DeliveryCost;
use App\Models\DeliveryOrder;

class CostConfigure extends Model
{
    protected $table = 'cost_configures';

    protected $fillable = ['delivery_cost_id','from','to','rate'];

    public function costs(){
        return $this->belongsTo(DeliveryCost::class, 'delivery_cost_id');
    }

    public function orders(){
        $this->hasMany(DeliveryOrder::class, 'range_id');
    }

}
