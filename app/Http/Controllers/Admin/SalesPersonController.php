<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

use App\Models\SalesPerson;
use App\Models\Supplier;
use App\Models\Customer;
use App\Models\User;

class SalesPersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $suppliers = Supplier::all();
        $customers = Customer::all();
        $persons = SalesPerson::all();
        return view('admin.sales.sales_person', compact('persons', 'users', 'suppliers', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $store = new SalesPerson();
        $store->type = $request->person_type;
        $store->commission = $request->commission;
        $store->fk_id = $request->person;
        $store->balance = 0;

        if($store->type=='Customer'){
            $customer = Customer::find($request->person);
            $store->name = $customer->name;
            $store->phone = $customer->phone;
        }
        elseif($store->type=='Supplier'){
            $supplier = Supplier::find($request->person);
            $store->name = $supplier->supplier_name;
            $store->phone = $supplier->phone;
        }
        else {
            $user = User::find($request->person);
            $store->name = $user->name;
            $store->phone = $user->phone;
        }
        $store->save();

        Session::flash('success', 'Sales Person Added Successfully!');

        return redirect()->route('person.index');
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

        $store = SalesPerson::find($id);
        $store->type = $request->person_type;
        $store->commission = $request->commission;
        $store->fk_id = $request->person;
        $store->balance = 0;

        if($store->type=='Customer'){
            $customer = Customer::find($request->person);
            $store->name = $customer->name;
            $store->phone = $customer->phone;
        }
        elseif($store->type=='Supplier'){
            $supplier = Supplier::find($request->person);
            $store->name = $supplier->supplier_name;
            $store->phone = $supplier->phone;
        }
        else {
            $user = User::find($request->person);
            $store->name = $user->name;
            $store->phone = $user->phone;
        }
        $store->save();

        Session::flash('success', 'Sales Person Updated Successfully!');

        return redirect()->route('person.index');
    }
}
