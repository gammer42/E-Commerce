<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DeliveryPerson;
use App\Models\CostConfigure;

class DeliveryAgent extends Model
{
    protected $table = 'delivery_agents'; 

    protected $fillable = ['name','mobile','address','email','contact_person_name','contact_person_phone'];

    public function persons(){
        return $this->hasMany(DeliveryPerson::class,'agent_id');
    }
}
