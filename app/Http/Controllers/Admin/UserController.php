<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use App\Role;
use App\Models\User;
use App\Models\Store;
use App\Models\Upazila;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        $upazilas = Upazila::all();
        $stores = Store::all();
        return view('admin.user.index', compact('users','roles', 'upazilas', 'stores'));
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();

        if($request->hasFile('img')){
            $image = $request->file('img');
            $imageName = $request->name.'_'.mt_rand(100,999).time().'.'.$image->getClientOriginalExtension();
            $uploadPath = 'storage/images/users/photos/';
            $image->move($uploadPath, $imageName);
            $user->img = $imageName;
        }

        if($request->hasFile('file')){
            $image = $request->file('file');
            $imageName = $request->name.'_'.mt_rand(100,999).time().'.'.$image->getClientOriginalExtension();
            $uploadPath = 'storage/images/users/files/';
            $image->move($uploadPath, $imageName);
            $user->file = $imageName;
        }


        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->job_title = $request->job_title;
        $user->salary = $request->salary;
        $user->nid  = $request->nid;
        $user->blood_group = $request->blood_group;
        $user->store_id = $request->store;
        $user->address = $request->address;
        $user->upazila_id = $request->upazila;
        $user->dob = Carbon::parse($request->dob);
        $user->join_date = Carbon::parse($request->join_date);
        $user->is_access = true;
        $user->save();

        $user->roles()->attach($request->role);

        return redirect()->route('user.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::findOrfail($id);
        return view('admin.user.show', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $upazilas = Upazila::all();
        $stores = Store::all();

        return view('admin.user.edit', compact('user', 'roles', 'upazilas', 'stores'));
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
        $user = User::findORFail($id);

        if($request->hasFile('img')){
            $image_path = 'storage/images/users/photos/' . $user->img;
            if(File::exists($image_path)){
                File::delete($image_path);
            }
            $image = $request->file('img');
            $imageName = $request->name.'_'.mt_rand(100,999).time().'.'.$image->getClientOriginalExtension();
            $uploadPath = 'storage/images/users/photos/';
            $image->move($uploadPath, $imageName);
            $user->img = $imageName;
        }

        if($request->hasFile('file')){
            $image_path = 'storage/images/users/files/' . $user->file;
            if(File::exists($image_path)){
                File::delete($image_path);
            }
            $image = $request->file('file');
            $imageName = $request->name.'_'.mt_rand(100,999).time().'.'.$image->getClientOriginalExtension();
            $uploadPath = 'storage/images/users/files/';
            $image->move($uploadPath, $imageName);
            $user->file = $imageName;
        }

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->job_title = $request->job_title;
        $user->salary = $request->salary;
        $user->nid  = $request->nid;
        $user->blood_group = $request->blood_group;
        $user->store_id = $request->store;
        $user->address = $request->address;
        $user->upazila_id = $request->upazila;
        $user->dob = Carbon::parse($request->dob);
        $user->join_date = Carbon::parse($request->join_date);
        $user->is_access = true;
        $user->save();

        DB::table('role_user')->where('user_id',$id)->delete();
        $user->roles()->attach($request->role);

        Session::flash('success', 'User Information Updated!');
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $image_path = 'storage/images/users/photos/' . $user->img;
               if (File::exists($image_path)) {
                   File::delete($image_path);
                }
        $image_path = 'storage/images/users/files/' . $user->file;
               if (File::exists($image_path)) {
                   File::delete($image_path);
                }
        $user->delete();

        Session::flash('success', 'Selected User Delete Successfully!');

        return redirect()->route('user.index');
    }
}
