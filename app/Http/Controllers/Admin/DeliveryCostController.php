<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\DeliveryPerson;
use App\Models\CostConfigure;
use App\Models\DeliveryAgent;
use Illuminate\Http\Request;
use App\Models\DeliveryCost;

class DeliveryCostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agents = DeliveryAgent::all();
        $staffs = DeliveryPerson::where('type','=', 'Staff')->get();
        $agent_persons = DeliveryPerson::where('type','=', 'Agent')->get();
        $costs = DeliveryCost::all();
        return view('admin.delivery.costs', compact('costs', 'agents', 'staffs', 'agent_persons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $store = new DeliveryCost();
        $store->cost_name = $request->delivery_cost_name;
        if($request->person_type == 'Agent'){
            $store->delivery_person = $request->agent_person;
        }
        else{
            $store->delivery_person = $request->staff_name;
        }
        $store->save();

        foreach($request->from as $key => $from){
            $cost = new CostConfigure();
            $cost->from = $request->from[$key];
            $cost->to = $request->to[$key];
            $cost->rate = $request->rate[$key];
            $cost->delivery_cost_id = $store->id;
            $cost->save();
        }

        Session::flash('success','Delivery Cost Added!');
        return redirect()->route('delivery.costs');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $store = DeliveryCost::find($id);
        $store->cost_name = $request->delivery_cost;
        $store->delivery_person = $request->agent_name;
        $store->save();

        $person = CostConfigure::where('delivery_cost_id', $store->id)->delete();

        foreach($request->from as $key => $from){
            if(isset($form)){
            $cost = new CostConfigure();
            $cost->from = $request->from[$key];
            $cost->to = $request->to[$key];
            $cost->rate = $request->rate[$key];
            $cost->delivery_cost_id = $store->id;
            $cost->save();
            }
        }

        Session::flash('success','Delivery Cost Updated!');

        return redirect()->route('delivery.costs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alpha = DeliveryCost::find($id);
        CostConfigure::where('delivery_cost_id', $alpha->id)->delete();
        DeliveryCost::find($id)->delete();

        Session::flash('success', 'Delivery Cost Details Deleted');

        return redirect()->route('delivery.costs');
    }
}
