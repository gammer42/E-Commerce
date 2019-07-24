<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\PurchaseItem;
use App\Models\CurrentStock;
use App\Models\ProductStore;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Store;
use App\Models\Stock;
use Carbon\Carbon;

class PurchaseController extends Controller
{
    
    public function purchase(){
        $purchases = Purchase::all();
        $suppliers = Supplier::all();
        return view('admin.stock.purchases', compact('purchases', 'suppliers'));
    }
    
    public function purchase_store(Request $request){
        $store = new Purchase();
        
        $store->invoice_no = $request->invoice;
        $store->price = $request->price;
        $store->supplier_id = $request->supplier;
        $store->date = Carbon::parse($request->date);
        
        if($request->hasFile('memo')){
            $image = $request->file('memo');
            $imageName = 'memo_'.str_random(6).'.'.$image->getClientOriginalExtension();
            $uploadPath = 'storage/images/purchase/memo/';
            $image->move($uploadPath, $imageName);
            $store->memo = $imageName;
        }
        
        $store->save();
        
        Session::flash('message', 'New Purchase Details Added!');
        
        return redirect()->route('purchases');
    }
    
    public function purchase_update(Request $request, $id){
        // dd($request);
        $store = Purchase::findOrFail($id);
        
        $store->invoice_no = $request->invoice;
        $store->price = $request->price;
        $store->supplier_id = $request->supplier;
        $store->date = Carbon::parse($request->date);
        
        if($request->hasFile('memo')){
            $image_path = 'storage/images/purchase/memo/' . $store->memo;
            if(File::exists($image_path)){
                File::delete($image_path);
            }
            $image = $request->file('memo');
            $imageName = 'memo_'.str_random(10).'.'.$image->getClientOriginalExtension();
            $uploadPath = 'storage/images/purchase/memo/';
            $image->move($uploadPath, $imageName);
            $store->memo = $imageName;
        }
        
        $store->save();

        Session::flash('message', 'Purchase Details Updated!');
        
        return redirect()->route('purchases');
    }
    
    public function purchase_destroy($id){
        Purchase::findOrFail($id)->delete();
        
        Session::flash('error', 'Purchase Details Deleted');
        return redirect()->route('purchases');
    }

    public function purchase_item(){
        $purchases = Purchase::all();
        $products = Product::all();
        $items = PurchaseItem::all();
        return view('admin.stock.purchase_item', compact('items','purchases','products'));
    }

    public function purchase_item_store(Request $request){
        $store = new PurchaseItem();
        $store->quantity = $request->quantity;
        $store->price = $request->price;
        $store->purchase_id = $request->purchase_id;
        $store->product_id = $request->product_id;
        $store->save();

        Session::flash('success','New Purchase Item Added!');

        return redirect()->route('purchase_item');
    }

    public function purchase_item_update(Request $request, $id){
        $store = PurchaseItem::findOrFail($id);
        $store->quantity = $request->quantity;
        $store->price = $request->price;
        $store->purchase_id = $request->purchase_id;
        $store->product_id = $request->product_id;
        $store->save();

        Session::flash('success','Purchase Item Updated!');

        return redirect()->route('purchase_item');
    }
    public function purchase_item_destroy($id){
        PurchaseItem::findOrFail($id)->delete();

        Session::flash('success','Purchase Item Deleted');

        return redirect()->route('purchase_item');
    }

    public function stock_out(){

        return view('admin.stock.stock_out');
    }
}
