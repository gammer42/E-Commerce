<?php

namespace App\Http\Controllers\Admin;

use App\Models\Store;
use App\Models\Supplier;
use App\Models\Customer;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Account;

class AccountManagementController extends Controller
{
    public function transactions(){
        return view('admin.account_management.transactions');
    }

    public function fund_transfer(){
        return view('admin.account_management.fund_transfer');
    }

    public function transaction_invoices(){
        return view('admin.account_management.transaction_invoices');
    }


    public function add_customer_transaction(){
        $string = 'Trans_id';
        $string = str_pad($string, 15, (Carbon::today()->format('d/Y')));
        $stores = Store::all();
        $customers = Customer::all();
        $accounts = Account::where('type', "Bank")->get();
        return view('admin.account_management.add_customer_transaction', compact('stores','customers','string','accounts'));
    }

    public function edit_customer_transaction(){

        return view('admin.account_management.edit_customer_transaction');
    }

    public function add_supplier_transaction(){
        $stores = Store::all();
        $suppliers = Supplier::all();
        $accounts = Account::where('type', "Bank")->get();
        return view('admin.account_management.add_supplier_transaction',compact('suppliers','stores','accounts'));
    }

    public function edit_supplier_transaction(){
        return view('admin.account_management.edit_supplier_transaction');
    }

    public function add_office_transaction(){
        return view('admin.account_management.add_office_transaction');
    }

    public function edit_office_transaction(){
        return view('admin.account_management.edit_office_transaction');
    }

    public function add_employee_transaction(){
        return view('admin.account_management.add_employee_transaction');
    }

    public function edit_employee_transaction(){
        return view('admin.account_management.edit_employee_transaction');
    }

    public function add_investor_transaction(){
        return view('admin.account_management.add_investor_transaction');
    }

    public function edit_investor_transaction(){
        return view('admin.account_management.edit_investor_transaction');
    }
}
