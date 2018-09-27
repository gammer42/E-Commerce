<?php

namespace App\Http\Controllers;

use App\Components\FlashMessages;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Http\Response;
use DB;
use App\category_tbl;
use Session;

class CategoryController extends Controller

{

//    public function __construct()
//    {
//        $this->AdminAuthCheck();
//    }

    public function add_category()
    {
        $this->AdminAuthCheck();
    	return view('admin.partial.category.add_category');
    }

    public function all_category()
    {
        $this->AdminAuthCheck();
    	$all_category_info = DB::table('category_tbls')->get();

    	return view('admin.partial.category.all_category')
    			->with('all_category_info', $all_category_info);

    }

    public function save_category(Request $request)
    {
    	$data = new category_tbl();
    	$data->id = $request->input('id');
    	$data->category_name = $request->input('category_name');
    	$data->category_description = $request->input('category_description');
    	$data->publication_status = $request->input('publication_status');

    	$data->save();

    	Session::put('message','Category added successfully...');
    	return Redirect::to('add_category');
    }

    public function active_category($id)
    {
    	DB::table('category_tbls')
    		->where('id',$id)
    		->update(['publication_status' => 1]);
    	// $c_name = DB::table('category_tbls')->where('id',$id)->first('category_name');
    		Session::put('message','Category Activated successfully...');
    		return Redirect::to('all_category');
    }

    public function inactive_category($id)
    {
    	DB::table('category_tbls')
    		->where('id',$id)
    		->update(['publication_status' => 0]);
    	// $c_name = DB::table('category_tbls')->where('id',$id)->first('category_name');
    		Session::put('message','Category Inactivated successfully...');
    		return Redirect::to('all_category');
    } 

    public function edit_category($id){
    	
    	$all_category_info = DB::table('category_tbls')
    		->where('id',$id)
    		->first();
    		// dd($all_category_info);

    	 return view('admin.partial.category.edit_category')
    	 		->with('all_category_info', $all_category_info);

    	// return view('ext/layouts/admin_layout')
    	// 	->with('admin.partial.edit_category', $category_info);

    }

    public function update_category(Request $request, $id)
    {	
    	$data = category_tbl::find($id);
        $data->category_name = $request->category_name;
        $data->category_description = $request->category_description;
        $data->save();

        Session::put('message','Update Successfully!');
        return Redirect::to('all_category');
    }

    public function delete_category($id){
    	DB::table('category_tbls')
    		    ->where('id',$id)
    		    ->delete();
    	Session::put('message','Category Deleted successfully');
    	return Redirect::to('all_category');

    }
    public function AdminAuthCheck(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return redirect()->back();
        } else {
            Session::put('error','You have to login first!!!');
            return Redirect::to('admin_log_page')->send();
        }
    }

}
