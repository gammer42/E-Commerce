<?php

namespace App\Http\Controllers\Admin;

use App\Models\SupplierReturn;
use App\Models\Supplier;
use App\Models\Stock;
use App\Models\CurrentStock;
use App\Models\ProductStore;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplierReturnController extends Controller
{
    public function index()
    {
        $supplier_returns = SupplierReturn::all();
        return view('admin.supplier_return.index', compact('supplier_returns'));
    }
    public function create()
    {
        $suppliers = Supplier::all();
        return view('admin.supplier_return.create', compact('suppliers'));
    }
    public function edit($id)
    {
        $supplier_return = SupplierReturn::find($id);
        $suppliers = Supplier::all();
        return view('admin.supplier_return.edit', compact('suppliers', 'supplier_return'));
    }
    public function store(Request $request)
    {
        $store = new SupplierReturn();
        $store ->supplier_id = $request->supplier_id;
        $store ->purchase_id = $request->purchase_id;
        $store ->cause = $request->cause;
        $store ->supplier_returns = $request->supplier_returns;
        $store->save();

        $stocks = Stock::where('purchase_item_id', $request->purchase_item_id)->get();
        foreach ($stocks as $key => $stock) {
            $product_store = ProductStore::where('store_id', $stock->store_id)->where('product_id',$stock->purchaseItems->product_id)->first();
            $c_stocks = CurrentStock::where('product_store_id', $product_store->id)->first();

            if ($stock->quantity <= $c_stocks->quantity) {
                $c_stocks->quantity = $c_stocks->quantity - $stock->quantity;
                $c_stocks->save();
                $stock->delete();
            }

            if($stock->quantity > $c_stocks->quantity)
            {
                $stock->quantity = $stock->quantity - $c_stocks->quantity;
                $c_stocks->quantity = 0;
                $stock->save();
                $c_stocks->save();
            }

        }
        return redirect()->route('supplier_return.index');
    }
    public function update(Request $request, $id)
    {
        $supplier_return = SupplierReturn::find($id);
        $supplier_return->supplier_returns = $request->supplier_returns;
        $supplier_return->save();
        return redirect()->route('supplier_return.index');
    }
    public function destroy($id)
    {
        //
    }
}
