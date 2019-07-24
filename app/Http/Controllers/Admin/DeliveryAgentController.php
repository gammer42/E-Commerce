<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeliveryAgent;

class DeliveryAgentController extends Controller
{
    public function index(){
        $agents = DeliveryAgent::all();
        return view('admin.delivery.agent', compact('agents'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'email' => 'required',
            'contact_person_name' => 'required',
            'contact_person_mobile' => 'required'
        ]);

        $agent = new DeliveryAgent();
        $agent->name = $request->name;
        $agent->mobile = $request->mobile;
        $agent->address = $request->address;
        $agent->email = $request->email;
        $agent->contact_person_name = $request->contact_person_name;
        $agent->contact_person_phone = $request->contact_person_mobile;
        $agent->save();

        Session::flash('success', 'Agent Added Successfully!');
        return redirect()->route('delivery.agent');
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'address' => 'required',
            'email' => 'required',
            'contact_person_name' => 'required',
            'contact_person_mobile' => 'required'
        ]);

        $agent = DeliveryAgent::findOrFail($id);
        $agent->name = $request->name;
        $agent->mobile = $request->mobile;
        $agent->address = $request->address;
        $agent->email = $request->email;
        $agent->contact_person_name = $request->contact_person_name;
        $agent->contact_person_phone = $request->contact_person_mobile;
        $agent->save();

        Session::flash('success', 'Agent Updated Successfully!');
        return redirect()->route('delivery.agent');
    }

    public function destroy($id){
        DeliveryAgent::findOrFail($id)->delete();

        Session::flash('success', 'Agent Deleted!');
        return redirect()->route('delivery.agent');
    }
}
