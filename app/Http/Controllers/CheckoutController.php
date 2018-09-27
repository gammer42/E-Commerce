<?php

namespace App\Http\Controllers;

use App\shipping;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\customer;



class CheckoutController extends Controller
{

    public function index()
    {
        return view('checkout'); 
    }

    public function create()
    {
        //
    }

    public function save_shipping_address(Request $request)
    {
        echo "Hello";
        $data = new shipping();
        $data->customer_id = $request->input('customer_id');
        $data->s_first_name = $request->input('s_first_name');
        $data->s_last_name = $request->input('s_last_name');
        $data->s_phone_no = $request->input('s_phone_no');
        $data->s_address = $request->input('s_address');
        $data->s_email = $request->input('s_email');
        $data->save();

        $shipping_id = shipping::select('id')->orderBy("created_at", "desc")->first();
        $request->session()->put('shipping_id',$shipping_id->id);
        dd(session('shipping_id'));
        return Redirect::to('/payment');
    }

    public function payment()
    {
        return view('payment');
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function log_check(Request $request)
    {
        $c_email = $request->c_email;
        $username = $request->c_email;
        $c_password = $request->c_password;
        $result = DB::table('customers')
            ->where('c_password',$c_password)
            ->where('c_email',$c_email)
            ->orWhere('username',$username)
            ->first();

        if($result){
            Session::put('user',$result->first_name);
            Session::put('customer_id',$result->customer_id);

            return redirect()->back();
            // ->with(compact('id'));
        }
        else{
            Session::put('error',"The username or password invalid");
            return redirect()->back();
        }
    }

    public function newcustomer(Request $request)
    {
        $this->validate($request,[
            'username' => 'required|unique:customers,username',
            'c_email' => 'required|unique:customers,c_email'
        ]);


        $data = new customer();

        $data->first_name = $request->input('first_name');
        $data->last_name = $request->input('last_name');
        $data->username = $request->input('username');
        $data->c_email = $request->input('c_email');
        $data->c_password = $request->input('c_password');
        $data->phone = $request->input('phone');
        $data->save();
        $user = $request->username;
        $da = DB::table('customers')->where('username',$user)->first();
        Session::put('user',$da->username);
        Session::put('id',$da->customer_id);
        return redirect()->back();
    }

}
