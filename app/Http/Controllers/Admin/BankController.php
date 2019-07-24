<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BankController extends Controller
{
    public function index(){

        $general_banks = Bank::where('type', 1)->get();
        $mobile_banks = Bank::where('type', 2)->get();
        return view('admin.account_settings.bank_name', compact('general_banks', 'mobile_banks'));
    }
    public function store(Request $request){

        $bank = new Bank();
        $bank->name = $request->bank_name;
        $bank->type = $request->bank_type;
        $bank->save();
        return redirect()->route('bank.index');
    }

    public function update(Request $request, $id){
        
        $bank = Bank::find($id);
        $bank->name = $request->bank_name;
        $bank->type = $request->bank_type;
        $bank->save();
        return redirect()->route('bank.index');
    }

    public function destroy($id){

        $bank = Bank::find($id);
        if(isset($bank)){
            $bank->delete();
        }
        return redirect()->route('bank.index');
    }
}
