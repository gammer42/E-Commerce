<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\CustomerAddress;
use App\Models\CustomerType;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\District;
use App\Models\Upazila;
use App\Models\Point;
use App\Models\Phone;
use Carbon\Carbon;

class CustomerController extends Controller
{

      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = CustomerType::all();
        $districts = District::all();

        return view('admin.customer.create', compact('districts','types'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = CustomerType::all();
        $customers = Customer::all();
        $districts = District::all();

        return view('admin.customer.index', compact('customers','districts','types'));
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
            'phone' => 'required|unique:customers|digits:11',
        ]);

        if($request->hasFile('photo')){
            $image = $request->file('photo');
            $imageName = 'customer_'.str_random(10).'.'.$image->getClientOriginalExtension();
            $uploadPath = 'storage/images/customer/';
            $image->move($uploadPath, $imageName);
        }

        $customer = new Customer();
        $customer->membership_id = $request->membership_id;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->gender = $request->gender;
        $customer->dob = Carbon::parse($request->dob);
        $customer->marital_status = $request->marital_status;
        $customer->anniversary_date = Carbon::parse($request->anniversary_date);
        $customer->img = $imageName;
        // $customer->due_amount = $request->
        // $customer->advanced_amount = $request->
        // $customer->earned_point = $request->
        $customer->description = $request->description;
        $customer->type_id = $request->customer_type;
        $customer->save();

       if(isset($request->alt_phone)){
            foreach($request->alt_phone as $phone){
                $p = new Phone();
                $p->phone = $phone;
                $p->des = $request->name;
                $p->save();
                $customer->phones()->attach($p);
            }
       }
        foreach ($request->address_type as $key => $value) {
            $customer_address = new CustomerAddress();
            $customer_address->phone = $request->address_phone[$key];
            $customer_address->address_type = $request->address_type[$key];
            $customer_address->street = $request->street[$key];
            $customer_address->district_id = $request->district_id[$key];
            $customer_address->customer_id = $customer->id;
            $customer_address->save();
        }

        Session::flash('success','Customer info successfully saved.');

        return redirect()->route('customer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customerDetail = Customer::find($id);
        return view('admin.customer.show', compact('customerDetail'));
    }


       /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        $types = CustomerType::all();
        $districts = District::all();
        return view('admin.customer.edit', compact('customer','districts','types'));
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
        $customer = Customer::find($id);
        // $customer->phones->delete();
        // dd($customer->phones);
        // dd($request);

        if($request->hasFile('photo')){
            $image_path = 'storage/images/customer/' . $customer->img;
            if (File::exists($image_path)) {
                File::delete($image_path);
            }

            $image = $request->file('photo');
            $imageName = 'customer_'.str_random(10).'.'.$image->getClientOriginalExtension();
            $uploadPath = 'storage/images/customer/';
            $image->move($uploadPath, $imageName);

            $customer->img = $imageName;
        }

        $customer->membership_id = $request->membership_id;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->gender = $request->gender;
        $customer->dob = Carbon::parse($request->dob);
        $customer->marital_status = $request->marital_status;
        $customer->anniversary_date = Carbon::parse($request->anniversary_date);
        // $customer->due_amount = $request->
        // $customer->advanced_amount = $request->
        // $customer->earned_point = $request->
        $customer->description = $request->description;
        $customer->type_id = $request->customer_type;
        $customer->save();

        foreach($customer->phones as $det){
            $customer->phones()->detach($det);
            $det->delete();
        }

        if(isset($request->alt_phone)){
            foreach($request->alt_phone as $phone){
                $p = new Phone();
                $p->phone = $phone;
                $p->des = $request->name;
                $p->save();
                $customer->phones()->attach($p);
            }
        }

        foreach($customer->address as $add){
            $add->delete();
        }

        foreach ($request->address_type as $key => $value) {
            $customer_address = new CustomerAddress();
            $customer_address->phone = $request->address_phone[$key];
            $customer_address->address_type = $request->address_type[$key];
            $customer_address->street = $request->street[$key];
            $customer_address->district_id = $request->district_id[$key];
            $customer_address->customer_id = $customer->id;
            $customer_address->save();
        }

        Session::flash('success','Customer Info. Updated Successfully');
        return redirect()->route('customer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        foreach($customer->address as $add){
            $add->delete();
        }
        foreach($customer->phones as $det){
            $customer->phones()->detach($det);
            $det->delete();
        }
        $customer->delete();

        Session::flash('error','Customer Deleted Successfully!!');

        return redirect()->route('customer.index');
    }

    public function pointUpdate(Request $request){
        $points = Point::findOrFail(1);

        if($request->point){
            $points->point = 1;
            $points->earn_rate = $request->point;
            $points->save();
            return redirect()->route('customerpoint')->with('success','Customer Points Updates Successfully.');
        }

        if($request->redeem){
            $points->point = 1;
            $points->redeem_rate = $request->redeem;
            $points->save();
            return redirect()->route('customerpoint')->with('success','Redeem Rate Updates Successfully.');
        }
    }

    public function point(){
        $point = Point::findOrFail(1);
        return view('admin.customer.points', compact('point'));
    }
}
