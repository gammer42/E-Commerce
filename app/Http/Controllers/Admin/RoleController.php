<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        $roles = Role::all();
        return view('admin.role.index', compact('roles','permissions'))->with('i', 1);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $role = new Role();
        $role->name = $request->name;
        $role->slug = $request->slug;
        $role->save();

        if ($request->permission) {
            foreach ($request->permission as $permission) {
                $role->permissions()->attach($permission);
            }
        }

        Session::flash('success', 'New Role Created!!!');
        return redirect()->route('role.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::with('permissions')->where('id', $id)->first();
        return view('admin.role.show', compact('role'))->with('i', 1);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('admin.role.edit', compact('role', 'permissions'))->with('i', 1);
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
        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->slug = $request->slug;
        $role->save();

        DB::table('permission_role')->where('permission_role.role_id', $id)->delete();

        if ($request->permission) {
            foreach ($request->permission as $permission) {
                $role->permissions()->attach($permission);
            }
        }
        Session::flash('success', 'Roles Updated Successfully!!!');
        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::findOrFail($id)->delete();

        Session::flash('success', 'Roles Delete Successfully!!!');
        return redirect()->route('role.index');
    }
}
