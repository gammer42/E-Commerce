<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\DeliveryPerson;
use App\Models\DeliveryAgent;
use App\Models\CostConfigure;
use Illuminate\Http\Request;
use App\Models\User;

class DeliveryPersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $persons = DeliveryPerson::all();
        $agents = DeliveryAgent::all();
        $users = User::all();
        return view('admin.delivery.persons', compact('persons','users', 'agents'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->person_type=='Staff'){
            $name = User::find($request->staff);
            $store = new DeliveryPerson();
            $store->type = $request->person_type;
            $store->contact_p_name = $name->name;
            $store->added_by = Auth::user()->id;
            $store->contact_p_phone = $request->staff_contact_number;
            $store->staff_id = $request->staff;
            $store->save();
        }
        if($request->person_type=='Agent'){
            $store = new DeliveryPerson();
            $store->type = $request->person_type;
            $store->contact_p_name = $request->agent_name;
            $store->added_by = Auth::user()->id;
            $store->contact_p_phone = $request->agent_contact_number;
            $store->agent_id = $request->agent;
            $store->save();
        }

        Session::flash('success','Delivery Person Create Successfully!');

        return redirect()->route('delivery.persons');
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
        if($request->person_type=='Staff'){
            $name = User::find($request->staff);
            $store = DeliveryPerson::find($id);
            $store->type = $request->person_type;
            $store->contact_p_name = $name->name;
            $store->contact_p_phone = $request->staff_contact_number;
            $store->staff_id = $request->staff;
            $store->save();
        }
        if($request->person_type=='Agent'){
            $store = DeliveryPerson::find($id);
            $store->type = $request->person_type;
            $store->contact_p_name = $request->agent_name;
            $store->contact_p_phone = $request->agent_contact_number;
            $store->agent_id = $request->agent;
            $store->save();
        }

        Session::flash('success','Delivery Person Updated Successfully!');

        return redirect()->route('delivery.persons');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $p = DeliveryPerson::find($id);
        $p->rates()->delete();
        $p->costs()->delete();
        $p->delete();

        Session::flash('error','Delevery Person Deleted!');
        return redirect()->route('delivery.persons');
    }
}
