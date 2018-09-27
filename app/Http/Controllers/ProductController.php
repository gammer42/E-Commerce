<?php

namespace App\Http\Controllers;

use App\Components\FlashMessages;
use Illuminate\support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response;
use DB;
use App\product;
use Session;
session_start();

class productController extends Controller
{
    /**
     * Display a listing of the source.
     *
     * @return \Illuminate\Http\Response
     */
//    public function __construct()
//    {
//        $this->AdminAuthCheck();
//    }
    public function all_product()
    {
        $this->AdminAuthCheck();
        $all_publish_product = DB::table('category_tbls')->join('products','category_tbls.id','=','products.category_id')->join(
            'manufactures','products.manufacture_id','=','manufactures.manufacture_id')->orderby('products.id','asc')->get();
//        dd(@$all_publish_product);
        return view('admin.partial.product.view_product', compact('all_publish_product'));
    }

    public function add_product()
    {
        $this->AdminAuthCheck();
        return view('admin.partial.product.add_product');
    }

    /**
     * Store a newly created source in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|Response
     */
    public function store(Request $request)
    {
//        dd($request);
        $data = new product();
        $data->category_id = $request->category_id;
        $data->manufacture_id = $request->manufacture_id;
        $data->product_name = $request->product_name;
        $data->product_description = $request->product_description;
        $data->product_price = $request->product_price;
//        $data->product_image = $request->product_image;
        $data->product_size = $request->product_size;
        $data->product_color = $request->product_color;
        $data->stock = $request->stock;
        $data->product_status = $request->product_status;
        $data->slider_status = $request->slider_status;

//
//        $image = $request->file('product_image');
//        if ($image) {
//            $img_name = str_random(20);
//            $ext = strtolower($image->getClientOriginalExtension());
//            $img_full_name = $img_name.'.'.$ext;
//            $path = 'public/image/';
//            $img_url = $path.$img_full_name;
//            $success = $image->move($path,$img_full_name);
//            if ($success) {
//                $data['product_image'] = $img_url;
//
//                DB::table('tbl_products')->insert($data);
//                Session::put('message', 'Producted successfully added!!..');
//                return Redirect::to('/add-product');
//            }
//        }
//
//        $data['product_image'] = '';
//        DB::table('tbl_products')->insert($data);
//        Session::put('message', 'Producted successfully added without Image!!..');
//        return Redirect::to('/add-product');


        $img = $request->file('product_image');
//        dd($img);
        $name = $img->getClientOriginalName();
//        dd($name);
        $path = public_path("/img");
        $img->move($path, $name);
        $data->product_image = $name;
        $data->save();

        Session::put('message', 'Product Add Successfully');

        return Redirect::to('add_product');
    }

    public function edit_product($id)
    {
        $product=DB::table('products')->where('id',$id)->first();
        return view('admin.partial.product.edit_product',compact('product'));
    }

    public function update_product(Request $request, $id)
    {
        $update = product::find($id);
        $update->category_id = $request->category_id;
        $update->manufacture_id = $request->manufacture_id;
        $update->product_name = $request->product_name;
        $update->product_description = $request->product_description;
        $update->product_price = $request->product_price;
//        $update->product_image = $request->product_image;
        $update->product_size = $request->product_size;
        $update->product_color = $request->product_color;
        $update->stock = $request->stock;
        $update->product_status = $request->product_status;
        $update->slider_status = $request->slider_status;

        $update->save();

        Session::put('message','Product Updated!');
        return Redirect::to('product');
    }

    public function deactivate_product($id)
    {
        DB::table('products')->where('id', $id)->update(['product_status'=> 0]);
        Session::put('message', 'Product Deactivated!');
        return Redirect::to('product');
    }


    public function activate_product($id)
    {
        DB::table('products')->where('id', $id)->update(['product_status'=> 1]);
        Session::put('message', 'Product Activated!');
        return Redirect::to('product');
    }

    public function deactivate_slider($id)
    {
        DB::table('products')->where('id', $id)->update(['slider_status'=> 0]);
        Session::put('message', 'Slider Deactivated!');
        return Redirect::to('product');
    }

    public function activate_slider($id)
    {
        DB::table('products')->where('id', $id)->update(['slider_status'=> 1]);
        Session::put('message', 'Slider Activated!');
        return Redirect::to('product');
    }

    public function delete_product($id)
    {
        DB::table('products')->where('id', $id)->delete();
        Session::put('message', 'Product Deleted!');
        return Redirect::to('product');
    }

    public function AdminAuthCheck(){
        $admin_id = Session::get('admin_id');
        if($admin_id)return redirect()->back();
        else {
            Session::put('error','You have to login first!!!');
            return Redirect::to('admin_log_page')->send();
        }
    }
}


