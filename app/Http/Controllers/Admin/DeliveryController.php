<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agent;
use App\Models\User;

class DeliveryController extends Controller
{   
    public function personStore(Request $request){
        dd($request);
    }

    public function personUpdate(Request $request, $id){

    }
    
    public function personDestroy($id){

    }

    public function costs(){
        return view('admin.delivery.costs');
    }

    public function orders(){
        return view('admin.delivery.orders');
    }

    public function cod(){
        return view('admin.delivery.cod');
    }

}
