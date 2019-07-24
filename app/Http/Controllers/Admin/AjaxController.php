<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\TransChildCategory;
use App\Models\CustomerAddress;
use App\Models\DeliveryPerson;
use App\Models\CostConfigure;
use App\Models\PurchaseItem;
use App\Models\ProductStore;
use App\Models\DeliveryCost;
use App\Models\Division;
use App\Models\District;
use App\Models\Purchase;
use App\Models\Customer;
use App\Models\Account;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Bank;

class AjaxController extends Controller
{
    public function purchase_price($id){
        $item = PurchaseItem::where('id', $id)->first();
        $purchase_buy  = $item->price/$item->quantity;

        $stocks = Stock::where('purchase_item_id',$id)->get();

        $alpha = 0;
        foreach($stocks as $stock){
            $alpha = $alpha + $stock->quantity;
        }

        $quantity = $item->quantity-$alpha;
        $date = $item->purchases->date;

        return response()->json([
            'success' => true,
            'search_price' => $purchase_buy,
            'quantity' => $quantity,
            'date' => $date
            ]);
    }

    public function banks_edit($id)
    {
        $banks = Bank::find($id);
        $bank_name = $banks->name;
        return response()->json(['success' => true, 'bank_name' => $bank_name, 'id'=>$banks->id]);
    }

    public function cats_edit($id){
        $cats = TransChildCategory::find($id);

        return response()->json([
            'success' => true,
            'type' => $cats->parents->type,
            'par' => $cats->parents->id,
            'cat' => $cats->name,
            'id' => $cats->id
        ]);
    }

    public function store_Stock($id)
    {
        $store = [];
        $purchases = Purchase::where('supplier_id', $id)->get();
        // dd($purchases);
        foreach($purchases as $key => $purchase) {
            // dd($stock->purchase_items->products->name, $key);
            $store[$key] = $purchase;
        }
        // dd($store);

        return response()->json([
            'success' => true,
            'store' => $store
            ]);
    }
    public function purchase_item($id)
    {
        $store = [];
        $purchase_items = PurchaseItem::where('purchase_id', $id)->get();
        // dd($purchase_items);
        foreach($purchase_items as $key => $item) {
            // dd($stock->item_items->products->name, $key);
            $store[$key] = $item->products;
            $invoice[$key] = $item->purchases->invoice_no;
        }
        // dd($store, $invoice);

        return response()->json([
            'success' => true,
            'purchase_item' => $store,
            'invoice' => $invoice
            ]);
    }

    public function order_add_product($id){
        $product = Product::find($id);

        $alpha = ProductStore::where('store_id', Auth::user()->stores->id)->where('product_id',$product->id)->first();
        $stock = $alpha->stocks->quantity;
        $price = $alpha->stocks->sell_price;
        return response()->json([
            'success' => true,
            'product_id' => $product->id,
            'product_name' => $product->name,
            'product_code' => $product->product_code,
            'stock' => $stock,
            'price' => $price
            ]);
    }

    public function account_type($id){
        $account = Account::find($id);

        $type = $account->type;

        return response()->json([
            'success' => true,
            'type' => $type
        ]);
    }
    public function agent_person($id){
        $agent_person = DeliveryPerson::where('agent_id', $id)->get();
        return response()->json([
            'success' => true,
            'agent_person' => $agent_person
        ]);
    }

    public function agent_person_service($id){
        $service = DeliveryCost::where('delivery_person',$id)->get(); 
        return response()->json([
            'success' =>true,
            'services' => $service
        ]);
    }
    public function agent_person_ranges($id){
        $beta = DeliveryCost::find($id);
        $ranges = $beta->ranges;
        return response()->json([
            'success' =>true,
            'ranges' => $ranges
        ]);
    }
    public function service_charge($id){
        $c = CostConfigure::where('id',$id)->select('rate')->first();
        return response()->json([
            'success' =>true,
            'charge' => $c->rate
        ]);
    }

    public function cus_address($id){
        $ca = CustomerAddress::where('customer_id',$id)->get();
        return response()->json([
            'success' =>true,
            'address' => $ca
        ]);
    }
    public function cus_address_ds($id){
        $ca = District::find($id);
        return response()->json([
            'success' =>true,
            'district' => $ca
        ]);
    }
    public function cus_address_dst($id){
        $ca = District::where('division_id',$id)->get();
        return response()->json([
            'success' =>true,
            'district' => $ca
        ]);
    }
    public function cus_address_dv($id){
        $ca = Division::find($id);
        return response()->json([
            'success' =>true,
            'division' => $ca
        ]);
    }

    public function fetch_products(Request $request){
        $query = $request->get('query');
        if(!$query)$data=null;
        else $data = DB::table('products')
            ->where('product_code', 'like', '%'.$query.'%')
            ->orWhere('name', 'like', '%'.$query.'%')
            ->orWhere('description', 'like', '%'.$query.'%')
            ->orderBy('id', 'desc')
            ->get();
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
//Product Name	Attr.	Batch	 Stock 	  Qty  	Unit Price	Dis(%)	VAT(%)	  Total
    public function cart_product($id){
        $product = Product::find($id);
        $alpha = ProductStore::where('store_id', Auth::user()->stores->id)->where('product_id',$product->id)->first();
        if(!isset($alpha->stocks)){
            return response()->json([
                'success' => true,
                'error' => 'This Product has No Stocks...!'
            ]);
        }
        $stock = $alpha->stocks->quantity;
        $price = $alpha->stocks->sell_price;
        $attr = $product->attributes;
        return response()->json([
            'success' => true,
            'product_id' => $product->id,
            'product_name' => $product->name,
            'product_code' => $product->product_code,
            'attribute' => $attr,
            'stock' => $stock,
            'price' => $price
            ]);
    }

    public function customerCommission($id){
        $cus = Customer::find($id);
        $dis = $cus->types->discount;
        return response()->json(['success'=>true, 'dis'=>$dis]);
    }
}
