<?php

namespace App\Http\Controllers;

use App\product;
use Illuminate\Http\Request;
use DB;
use Cart;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index(){
        return view('cart');
    }

    public function add_to_cart(Request $request, $id)
    {

        $qty=$request->quantity;
        $customer_id = $request->customer_id;
        $cart_product = DB::table('products')
            ->where('id',$id)->select('products.*')->first();

        if($cart_product->stock >=2 && $cart_product->stock <= $qty){

            Session::put('stock1','Out of stock... You can order ');
            Session::put('stock2',$cart_product->stock-1);
            Session::put('stock3',' maximum of this product...');
            return redirect()->back();
        }else{
//            DB::table('products')->where('id',$id)
//                ->decrement('stock', $qty);
            $data['qty'] = $qty;
            $data['cid'] = $customer_id;
            $data['id'] = $cart_product->id;
            $data['name'] = $cart_product->product_name;
            $data['price'] = $cart_product->product_price;
            $data['options']['image']= $cart_product->product_image;

            Cart::add($data);
        }
        return redirect()->back();
    }

    public function update(Request $request){
        $qty = $request->qty;
        $rowId = $request->rowId;

        Cart::update($rowId,$qty);
        return redirect()->back();

    }

    public function delete($rowId){

        Cart::update($rowId,0);
        return redirect()->back();
    }



}