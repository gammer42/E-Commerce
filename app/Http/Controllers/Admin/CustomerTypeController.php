<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CustomerType;
class CustomerTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customerTypes = CustomerType::all();
        return view('admin.customer.type', compact('customerTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'type_name' => 'required',
            'type_discount' => 'required',
            'target_sale' => 'required'
        ]);
        
        
        $type = new CustomerType();
        $type->type_name = request('type_name');
        $type->discount = request('type_discount');
        $type->target_sale = request('target_sale');
        $type->save();

        return redirect('customertype')->with('success','Customer Type Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.customer.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $this->validate($request, [
            'type_name' => 'required',
            'type_discount' => 'required',
            'target_sale' => 'required'
        ]);
        
        $type = CustomerType::find($id);
        $type->type_name = request('type_name');
        $type->discount = request('type_discount');
        $type->target_sale = request('target_sale');
        $type->save();

        return redirect('customertype')->with('success','Customer Type Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CustomerType::find($id)->delete();

        Session::flash('success', 'Customer Type successfully deleted!');

        return redirect()->route('customertype.index');
    }

}
