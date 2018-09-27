<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $publish_product = DB::table('category_tbls')->join('products','products.category_id','=','category_tbls.id')
            ->join('manufactures','products.manufacture_id','=','manufactures.manufacture_id')->where('products.product_status',1)
            ->where('manufactures.publication_status',1)->where('category_tbls.publication_status',1)->limit(9)->get();

        return view('index',compact('publish_product'));
    }

    public function show_category($id)
    {
        $publish_product = DB::table('category_tbls')->join('products','products.category_id','=','category_tbls.id')
            ->join('manufactures','products.manufacture_id','=','manufactures.manufacture_id')->where('products.category_id',$id)
            ->where('products.product_status',1)->where('manufactures.publication_status',1)
            ->where('category_tbls.publication_status',1)->limit(9)->get();
        $test = $publish_product;
        if($test == '[]') {
            return view('unavailable');
        }else{
            return view('product', compact('publish_product'));
        }

    }
    public function show_manufacture($manufacture_id)
    {
        $publish_product = DB::table('category_tbls')->join('products','products.category_id','=','category_tbls.id')
            ->join('manufactures','products.manufacture_id','=','manufactures.manufacture_id')
            ->where('products.manufacture_id',$manufacture_id)->where('products.product_status',1)->where('manufactures.publication_status',1)
            ->where('category_tbls.publication_status',1)->limit(9)->get();
        $test = $publish_product;
        $published_category = DB::table('category_tbls')->where('publication_status', 1)->limit(12)->get();
        $published_manufacture = DB::table('manufactures')->where('publication_status',1)->limit(15)->get();
        if($test != '[]') {
            return view('product', compact('publish_product'));
        }else{
            return Redirect::to('unavailable');
        }

    }

    public function store(Request $request)
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
        $da = DB::table('customers')->where('username', $user)->first();
        Session::put('user', $da->username);
        Session::put('id', $da->customer_id);
        return redirect('/');
    }

    public function view_product($id){
        $publish_product = DB::table('category_tbls')->join('products','products.category_id','=','category_tbls.id')
            ->join('manufactures','products.manufacture_id','=','manufactures.manufacture_id')->where('products.product_status',1)
            ->where('manufactures.publication_status',1)->where('category_tbls.publication_status',1)->limit(9)->get();
//        dd($publish_product);
        $product_detail = DB::table('category_tbls')->join('products','products.category_id','=','category_tbls.id')
            ->join('manufactures','products.manufacture_id','=','manufactures.manufacture_id')
            ->where('products.id',$id)->where('products.product_status',1)
            ->where('manufactures.publication_status',1)
            ->where('category_tbls.publication_status',1)->get();

        return view('product_details',compact('publish_product','product_detail'));
    }




}

