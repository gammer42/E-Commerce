<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TransChildCategory;
use App\Models\TransParCategory;


class TransactionCategoryController extends Controller
{  
    public function categories(){
        $expenses = TransParCategory::where('type',0)->get();
        $incomes = TransParCategory::where('type',1)->get();
        $cats = TransChildCategory::all();
        return view('admin.account_settings.expense_categories', compact('incomes', 'cats','expenses'));
    }

    public function categories_store(Request $request){

        $cats = new TransChildCategory();
        $cats->name = $request->c_cat;
        $cats->categories = $request->p_cat;
        $cats->save();
        return redirect()->route('account_settings.categories');
    }

    public function categories_update(Request $request, $id){

        $cats = TransChildCategory::find($id);
        $cats->name = $request->c_cat;
        $cats->categories = $request->p_cat;
        $cats->save();
        return redirect()->route('account_settings.categories');

    }

    public function categories_destroy($id){
        
        TransChildCategory::find($id)->delete();
        return redirect()->route('account_settings.categories');
    }
}
