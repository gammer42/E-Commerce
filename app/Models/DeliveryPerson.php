<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\DeliveryCost;
use App\Models\DeliveryAgent;
use App\Models\CostConfigure;
use App\Models\DeliveryOrder;


class DeliveryPerson extends Model
{
    protected $table = 'delivery_persons';

    protected $fillable = ['type','contact_p_name','contact_p_phone','added_by','staff_id','agent_id'];

    public function staffs(){
        return $this->belongsTo(User::class,'staff_id');
    }

    public function agents(){
        return $this->belongsTo(DeliveryAgent::class, 'agent_id');
    }

    public function adds(){
        return $this->belongsTo(User::class,'added_by');
    }

    public function costs(){
        return $this->hasMany(DeliveryCost::class, 'delivery_person');
    }
    
}
