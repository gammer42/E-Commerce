<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Models\ProductStore;
use App\Models\OrderProduct;
use App\Models\SalesPerson;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Account;
use App\Models\Order;
use App\Models\Store;
use App\Models\Bank;
use App\Models\Card;
use Carbon\Carbon;

class SalesOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();

        return view('admin.sales.order', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $persons = SalesPerson::all();
        $customers = Customer::all();
        $store = Store::find(Auth::user()->stores->id);
        $products = $store->products;
        $accounts = $store->accounts;
        $banks = Bank::all();
        $cards = Card::all();

        return view('admin.sales.order_add', compact('products', 'customers', 'persons', 'accounts', 'banks', 'cards'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $order = new Order();

        $order->invoice = $this->invoice();
        $order->date = date("Y-m-d");
        $order->notes = $request->note;
        $order->total = $request->grand_total;
        $order->advance = $request->payment;
        $order->status = 'Pending';
        $order->store_id = Auth::user()->stores->id;
        $order->sales_person_id = $request->person;
        $order->customer_id = $request->customer;
        $order->save();
        
        foreach($request->id as $i=>$id){
            $product = Product::find($id);
            $order_product = new OrderProduct();
            $order_product->p_name = $product->name;
            $order_product->p_code = $product->product_code;
            $order_product->quantity = $request->qty[$i];
            $order_product->unit_price = $request->price[$i];
            $order_product->discount = $request->dis[$i];
            $order_product->vat = $request->vat[$i];
            $order_product->total = $request->total[$i];
            $order_product->order_id = $order->id;

            $order_product->save();
        }

        // Payment Section

        $account = Account::find($request->account);
        $account->current_bal = $account->current_bal+$request->payment;
        $account->save();
        $card = Card::find($request->card);

        $payment = new Payment();

        $payment->type = 'Income';
        $payment->bank_name = $account->banks->name;
        if($account->type == 'Bank'){
            $payment->payment_method = $request->payment_method;
            if($payment->payment_method == 1){
                $payment->card_id = $request->card;
                $payment->customer_card_no = $request->card_acc_no;
                $payment->reff_transaction_no = $request->card_ref_no;
            }else{
                $payment->bank_id = $request->cheque_bank;
                $payment->customer_account_no = $request->cheque_acc_no;
            }
        }
        if($account->type == 'Mobile'){
            $payment->customer_account_no = $request->mobile_acc_no;
            $payment->reff_transaction_no = $request->mobile_ref_no;
        }
        $payment->account_id = $request->account;
        $payment->save();

        $payment->orders()->attach($order->id);
        return redirect()->route('sales.add_order');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function invoice(){
        
        $latest = Order::latest()->first();
        if (! $latest) {    
            return 'ord-00000001';
        }
        $string = preg_replace("/[^0-9\.]/", '', $latest->invoice);
        return 'ord-' . sprintf('%09d', $string+1);
    }
}
