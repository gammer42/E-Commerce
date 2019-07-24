<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Card;
use App\Models\Bank;
use App\Models\Store;
use App\Models\Account;

class AccountSettingController extends Controller
{
    public function account(){
        $banks = Account::where('type','Bank')->get();
        $cashes = Account::where('type','Cash')->get();
        $mobiles = Account::where('type','Mobile')->get();
        return view('admin.account_settings.account', compact('banks', 'cashes', 'mobiles'));
    }

    public function create(){
        $stores = Store::all();
        $banks = Bank::all();
        return view('admin.account_settings.create', compact('banks', 'stores'));
    }

    public function edit($id){
        $accounts = Account::find($id);
        $stores = Store::all();
        $banks = Bank::all();
        return view('admin.account_settings.edit', compact('accounts', 'banks', 'stores'));
    }

    public function card_type(){
        $cards = Card::all();
        return view('admin.account_settings.card_type', compact('cards'));
    }
    public function store(Request $request)
    {
        $account = new Account();

        $account->type = $request->acc_type;
        $account->uses = $request->acc_uses;
        $account->description = $request->acc_des;
        $account->initial_bal = $request->acc_init;
        $account->current_bal = $request->acc_init;
        if($account->type == "Bank"){
            $account->number = $request->number;
            $account->branch = $request->branch;
            $account->address = $request->address;
            $account->bank_id = $request->bank;
        }
        if($account->type == "Cash"){
            $account->name = $request->acc_name;
        }
        if($account->type == "Mobile"){
            $account->number = $request->number;
            $account->type_of_account = $request->com_radio;
            $account->transaction_cost = $request->acc_charge;
            $account->bank_id = $request->bank;
        }
        // dd($account);

        $account->save();

        foreach($request->store as $store){
            $account->stores()->attach($store);
        }
        return redirect()->route('account_settings.account');
    }
    public function update(Request $request, $id)
    {
        $account = Account::find($id);
        $account->type = $request->acc_type;
        $account->uses = $request->acc_uses;
        $account->description = $request->acc_des;
        $account->initial_bal = $request->acc_init;
        $account->current_bal = $request->acc_init;
        if($account->type == "Bank"){
            $account->number = $request->number;
            $account->branch = $request->branch;
            $account->address = $request->address;
            $account->bank_id = $request->bank;
        }
        if($account->type == "Cash"){
            $account->name = $request->acc_name;
        }
        if($account->type == "Mobile"){
            $account->number = $request->number;
            $account->type_of_account = $request->com_radio;
            $account->transaction_cost = $request->acc_charge;
            $account->bank_id = $request->bank;
        }
        // dd($account);

        $account->save();

        foreach($request->store as $store){
            $account->stores()->attach($store);
        }
        return redirect()->route('account_settings.account');
    }

}
