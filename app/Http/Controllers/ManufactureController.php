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
use App\manufacture;
use Session;

class ManufactureController extends Controller
{



//    public function __construct()
//    {
//        $this->middleware('AdminAuthCheck()');
//    }

	public function all_manufacture(){
	    $this->AdminAuthCheck();
		$all_manufacture_info = DB::table('manufactures')->get();
		return view('admin.partial.manufacture.all_manufacture',compact('all_manufacture_info'));
					// ->with('all_manufacture_info',$all_manufacture_info);
	}
	public function add_manufacture(){
	    $this->AdminAuthCheck();
		return view('admin.partial.manufacture.add_manufacture');
	}
    
    public function save_manufacture(Request $request){
        $this->AdminAuthCheck();
        $data = new manufacture();
    	$data->manufacture_id = $request->input('manufacture_id');
    	$data->manufacture_name = $request->input('manufacture_name');
    	$data->manufacture_description = $request->input('manufacture_description');
    	$data->publication_status = $request->input('publication_status');
    	$data->save();

    	Session::put('message','Manufacture Added Successfully...');

        return Redirect::to('add_manufacture');
    }

    public function active_manufacture($manufacture_id){
        $this->AdminAuthCheck();
        DB::table('manufactures')
    		->where('manufacture_id',$manufacture_id)
    		->update(['publication_status' => 1]);
    	Session::put('message','Activated');

    	return Redirect::to('manufacture');
    }

    public function inactive_manufacture($manufacture_id){
        $this->AdminAuthCheck();
        DB::table('manufactures')
    		->where('manufacture_id',$manufacture_id)
    		->update(['publication_status' => 0]);
    	Session::put('message','Dactivated!!!');
    	return Redirect::to('manufacture');
    }

    public function edit_manufacture($manufacture_id){
        $this->AdminAuthCheck();
        $all_manufacture_info = DB::table('manufactures')
    							->where('manufacture_id',$manufacture_id)
    							->first();

    	return view('admin.partial.manufacture.edit_manufacture',compact('all_manufacture_info'));
//    				->with('all_manufacture_info',$all_manufacture_info);
    }

    public function update_manufacture(Request $request, $manufacture_id){
        $this->AdminAuthCheck();
    	DB::table('manufactures')->where('manufacture_id',$manufacture_id)
    							 ->update(['manufacture_name'=>$request->manufacture_name,'manufacture_description'=>$request->manufacture_description]);
    	Session::put('message','Updated Successfully!');
    	return Redirect::to('manufacture');
    }

    public function delete_manufacture($manufacture_id){
        $this->AdminAuthCheck();
        DB::table('manufactures')->where('manufacture_id',$manufacture_id)
    							 ->delete();
    	Session::put('message','Delete Successfully!');
    	return Redirect::to('manufacture');
    }

    public function AdminAuthCheck(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return redirect()->back();
        }
        else {
            Session::put('error','You have to login first!!!');
            return Redirect::to('admin_log_page')->send();
        }
    }
}
