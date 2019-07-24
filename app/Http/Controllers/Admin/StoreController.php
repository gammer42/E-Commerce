<?php

namespace App\Http\Controllers\Admin;

use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = Store::all();
        return view('admin.store.index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.store.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $store = new Store();

        if($request->hasFile('logo')){
            $logo = $request->file('logo');
            $logoName = 'store_'.str_random(6).'.'.$logo->getClientOriginalExtension();
            $uploadPath = 'storage/images/store/logos/';
            $logo->move($uploadPath, $logoName);
            $store->logo = $logoName;
        }
        $store->name = $request->name;
        $store->email = $request->email;
        $store->phone = $request->phone;
        $store->city = $request->city;
        $store->location = $request->location;
        $store->post_code = $request->post_code;
        $store->address = $request->address;
        $store->description = $request->description;
        $store->vat_no = $request->vat_no;
        $store->description = $request->description;
        $store->save();

        Session::flash('success', 'Store Information Successfully Saved.');
        return redirect()->route('store.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $store = Store::findOrFail($id);

        return view('admin.store.show', compact('store'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $store = Store::findOrFail($id);

        return view('admin.store.edit', compact('store'));
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
        $store = Store::findOrFail($id);

        if($request->hasFile('logo')){
            $image_path = 'storage/images/store/logos/' . $request->old_logo;
               if (File::exists($image_path)) {
                   File::delete($image_path);
                }
            $logo = $request->file('logo');
            $logoName = 'store_'.str_random(6).'.'.$logo->getClientOriginalExtension();
            $uploadPath = 'storage/images/store/logos/';
            $logo->move($uploadPath, $logoName);
            $store->logo = $logoName;
        }
        $store->name = $request->name;
        $store->email = $request->email;
        $store->phone = $request->phone;
        $store->city = $request->city;
        $store->location = $request->location;
        $store->post_code = $request->post_code;
        $store->address = $request->address;
        $store->description = $request->description;
        $store->vat_no = $request->vat_no;
        $store->description = $request->description;
        $store->save();

        Session::flash('success','Store Information Updated Successfully!!');
        return redirect()->route('store.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Store::find($id)->delete();

        Session::flash('error', 'Store Info. Deleted Successfully.');
        return redirect()->route('store.index');
    }
}
