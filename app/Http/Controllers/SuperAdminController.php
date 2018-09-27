<?php

namespace App\Http\Controllers;

use Illuminate\support\Facades\Redirect;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;


class SuperAdminController extends Controller
{

    public function index()
    {
        $this->AdminAuthCheck();
        return view('admin.admin_dashboard');
    }


    public function admin_login_page()
    {
        return view('admin.admin_login');
    }


    public function admin_login(Request $request)
    {
        $admin_mail = $request->admin_mail;
        $admin_password = $request->admin_password;
        $result = DB::table('admins')
            ->where('admin_mail', $admin_mail)
            ->where('admin_password', $admin_password)
            ->first();

            if($result){
                Session::put('admin_name',$result->admin_name);
                Session::put('admin_id',$result->admin_id);
                return Redirect::to('dashboard');
            }else{
                Session::put('error','The username or password invalid');
                return Redirect::to('admin_log_page');
            }
    }


    public function admin_logout()
    {
        // Session::put('admin_name',null);
        // Session::put('admin_id',null);

        Session::flush();
        return Redirect::to('admin_log_page');
    }

    public function AdminAuthCheck(){
        $admin_id = Session::get('admin_id');
        if($admin_id) {
            return;
        }else {
                Session::put('error','You have to login first to get Dashboard!!!');
                return Redirect::to('admin_log_page')->send();
            }
    }

}
