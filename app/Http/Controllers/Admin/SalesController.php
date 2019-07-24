<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

use App\Models\CustomerAddress;
use App\Models\DeliveryPerson;
use App\Models\DeliveryAgent;
use App\Models\DeliveryOrder;
use App\Models\Division;
use App\Models\Customer;
use App\Models\Account;
use App\Models\Sale;

class SalesController extends Controller
{
    public function index(){

        $divisions = Division::all();
        $accounts = Account::all();
        $customers = Customer::all();
        $persons = DeliveryPerson::where('type', 'Staff')->get();
        $agents = DeliveryAgent::all();
        $invoice = $this->invoice();
        return view('admin.sales.index', compact('agents', 'invoice', 'customers', 'persons', 'accounts', 'divisions'));
    }

    public function sale_returns(){
        return view('admin.sales.sale_returns');
    }

    public function print_chalan(){
        return view('admin.sales.print_chalan');
    }

    public function sales_person(){
        return view('admin.sales.sales_person');
    }

    public function sales_commission(){
        return view('admin.sales.sales_commission');
    }
    public function add_sales_transaction(){
        return view('admin.sales.add_sales_transaction');
    }
    public function edit_sales_transaction(){
        return view('admin.sales.edit_sales_transaction');
    }

    public function sales_delivery(Request $request){
        
        if($request->invoice){
            $beta = DeliveryOrder::where('invoice',$request->invoice)->first();
            if($beta){
                $alpha = Account::find($beta->account_id);
                $alpha->current_bal = $alpha->current_bal+$beta->paid;
                $alpha->save();
                DeliveryOrder::where('invoice',$request->invoice)->delete();
            }
        }

        $delta = new DeliveryOrder();
        if($request->person_type == 'Agent'){
            $delta->memo_no = $request->memo_no;
            $delta->invoice = $request->invoice;
            $delta->type = $request->person_type;
            $delta->range_id = $request->service_range;
            $delta->person_id = $request->delivery_person;
            $delta->charge = $request->delivery_charge;
            $delta->account_id = $request->account;
            $delta->paid = $request->paid_amount;
            $delta->cod = $request->cod_charge;
            $delta->ref = $request->reff;
        }
        elseif($request->person_type == 'Staff'){
            $delta->invoice = $request->invoice;
            $delta->type = $request->person_type;
            $delta->range_id = $request->service_range;
            $delta->person_id = $request->delivery_person;
            $delta->charge = $request->delivery_charge;
            $delta->account_id = $request->account;
            $delta->paid = $request->paid_amount;
            $delta->cod = $request->cod_charge;
            $delta->ref = $request->reff;
        }

        if($request->radio_shipping==0){
            $address = new CustomerAddress();
            $address->address_type = 4;
            $address->district_id = $request->district;
            $address->customer_id = $request->customer;
            $address->street = $request->shipping_address;
            $address->save();
            $delta->customer_address_id = $address->id;
        }else{
            $delta->customer_address_id = $request->radio_shipping;
            $address = CustomerAddress::find($delta->customer_address_id);
        }
        $delta->save();

        $accounts = Account::find($delta->account_id);
        $accounts->current_bal = $accounts->current_bal-$delta->paid;
        $accounts->save();

        $due = $delta->charge-$delta->paid;
        $person = $delta->persons->contact_p_name;
        $service = $delta->ranges->costs->cost_name;
        $agent = null; 
        if($request->person_type == 'Agent'){
            $agent = $delta->persons->agents->name;
        }

        return response()->json([
            'success' => true,
            'delivery_type' => $delta->type,
            'agent_name' => $agent,
            'delivery_person' => $person,
            'service_name' => $service,
            'start_range' => $delta->ranges->from,
            'end_range' => $delta->ranges->to,
            'account' => $delta->accounts->name.' ('.$delta->accounts->number.')',
            'cod' => $delta->cod,
            'ref' => $delta->ref,
            'address' => $delta->addresses->street.', '.$delta->addresses->districts->name.', '. $delta->addresses->districts->divisions->name,
            'delivery_charge' => $delta->charge,
            'paid' => $delta->paid,
            'due' => $due
        ]); 
    }

    public function invoice(){
        
        $latest = Sale::latest()->first();
        if (! $latest) {    
            return 'sales-00000001';
        }
        $string = preg_replace("/[^0-9\.]/", '', $latest->invoice);
        return 'sales-' . sprintf('%09d', $string+1);
    }
}
