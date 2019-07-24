<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

use App\Models\StockRequisition;
use Illuminate\Http\Request;
use App\Models\ProductStore;
use App\Models\PurchaseItem;
use App\Models\CurrentStock;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Store;
use App\Models\Stock;

use Carbon\Carbon;


class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $availables = CurrentStock::all();
        return view('admin.stock.index', compact('availables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $purchase_item = PurchaseItem::all();
        $products = Product::all();
        $suppliers = Supplier::all();
        $stores = Store::all();
        return view('admin.stock.create', compact('products','suppliers','stores', 'purchase_item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $stock = new Stock();

        $stock->quantity = $request->quantity;
        $stock->date = Carbon::parse($request->date);
        $stock->buy_price = $request->add_buy_price;
        $stock->sell_price = $request->sell_price;
        $stock->store_id = $request->store;
        $stock->user_id = Auth::user()->id;
        $stock->purchase_item_id = $request->item;
        $stock->save();

        $p = ProductStore::where('store_id',$stock->store_id)->where('product_id',$request->product)->first();
        if(isset($p)){
            $p_store = $p;
        } else{
            $p_store = new ProductStore();
            $p_store->store_id = $stock->store_id;
            $p_store->product_id = $stock->purchaseItems->products->id;
            $p_store->save();
        }

        $c_stock = CurrentStock::where('product_store_id',$p_store->id)->first();

        if(isset($c_stock)){
            $c_stock->quantity = $c_stock->quantity+$request->quantity;
            $c_stock->buy_price = $request->buy_price;
            $c_stock->sell_price = $request->sell_price;
            $c_stock->save();
        } else{
            $c_stock = new CurrentStock();
            $c_stock->quantity = $request->quantity;
            $c_stock->buy_price = $request->add_buy_price;
            $c_stock->sell_price = $request->sell_price;
            $c_stock->product_store_id = $p_store->id;
            $c_stock->save();
        }


        Session::flash('success', 'New Stock Added!');

        return redirect()->route('stocks.index');
    }

    public function edit($id)
    {
        $stock = Stock::where('id', $id)->first();
        $stores = Store::all();
        $purchase_item = PurchaseItem::all();
        return view('admin.stock.stock_edit', compact('stock', 'stores', 'purchase_item'));
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
            'quantity' => 'required',
            'date' => 'required',
            'store' => 'required',
            'item' => 'required',
        ]);
        $stock = Stock::find($id);
        $alpha = $stock->quantity;
        $stock->quantity = $request->quantity;
        $stock->buy_price = $request->buy_price;
        $stock->sell_price = $request->sell_price;
        $stock->date = Carbon::parse($request->date);
        $stock->store_id = $request->store;
        $stock->purchase_item_id = $request->item;
        $stock->save();

        $p = ProductStore::where('store_id',$stock->store_id)->where('product_id',$stock->purchaseItems->products->id)->first();
        // dd($p);
        if(isset($p)){
            $p_store = $p;
        } else{
            $p_store = new ProductStore();
            $p_store->store_id = $stock->store_id;
            $p_store->product_id = $stock->purchaseItems->products->id;
            $p_store->save();
        }

        $c_stock = CurrentStock::where('product_store_id',$p_store->id)->first();

        if(isset($c_stock)){
            $c_stock->quantity = ($c_stock->quantity+$request->quantity)-$alpha;
            $c_stock->buy_price = $request->buy_price;
            $c_stock->sell_price = $request->sell_price;
            $c_stock->save();
        } else{
            $c_stock = new CurrentStock();
            $c_stock->quantity = $request->quantity;
            $c_stock->buy_price = $request->buy_price;
            $c_stock->sell_price = $request->sell_price;
            $c_stock->product_store_id = $p_store->id;
            $c_stock->save();
        }

        Session::flash('success', 'Stock Updated Successfully!');

        return redirect()->route('stocks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stock = Stock::find($id);
        $image_path = 'storage/images/' . $stock->memo_doc;
               if (File::exists($image_path)) {
                   File::delete($image_path);
                }
        $stock->delete();

        Session::flash('success', 'Stock Successfully deleted!');


        return redirect()->route('stocks.index');
    }

                // Stock Requisition Realated Function Hare //

    public function requisition(){

        $stores = Store::all();
        $products = Product::all();
        $requisitions = StockRequisition::all();
        return view('admin.stock.requisition', compact('requisitions', 'stores', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function requisition_store(Request $request){

        $p = ProductStore::where('store_id',$request->store)->where('product_id',$request->product)->first();
        if(isset($p)){
            $p_store = $p;
        } else{
            $p_store = new ProductStore();
            $p_store->store_id = $request->store;
            $p_store->product_id = $request->product;
            $p_store->save();
        }

        $requisition = new StockRequisition();

        $requisition->quantity = $request->quantity;
        $requisition->date = Carbon::parse($request->date);
        $requisition->status = false;
        $requisition->product_store_id = $p_store->id;
        $requisition->save();

        Session::flash('success', 'New Requisition Added!');

        return redirect()->route('requisition.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function requisition_check($id){
        $r = StockRequisition::find($id);
        $r->status = true;
        $r->save();

        return redirect()->route('requisition.index');
    }

    public function requisition_update(Request $request, $id){

        $p = ProductStore::where('store_id',$request->store)->where('product_id',$request->product)->first();

        $requisition = StockRequisition::find($id);

        $requisition->quantity = $request->quantity;
        $requisition->date = Carbon::parse($request->date);
        $requisition->product_store_id = $p->id;
        $requisition->save();

        Session::flash('success', 'Requisition Updated!');

        return redirect()->route('requisition.index');
    }

    public function requisition_destroy($id)
    {
        $r = StockRequisition::find($id);

        $r->delete();

        Session::flash('success', 'Requisition Deleted!');

        return redirect()->route('requisition.index');
    }

    public function stock_in(){

        $stocks = Stock::all();
        $stores = Store::all();
        $purchase_item = PurchaseItem::all();

        return view('admin.stock.stock_in', compact('stocks', 'stores', 'purchase_item'));
    }
}
