<?php

namespace App\Http\Controllers\Admin;


use App\Models\Upazila;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $upazilas = Upazila::all();
        $suppliers = Supplier::all();

        return view('admin.supplier.index', compact('suppliers','upazilas'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    
        $supplier = new Supplier();

        if($request->hasFile('img')){
            $image = $request->file('img');
            $imageName = 'supplier_'.mt_rand(100,999).time().'.'.$image->getClientOriginalExtension();
            $uploadPath = 'storage/images/suppliers/';
            $image->move($uploadPath, $imageName);
            $supplier->img = $imageName;
        }
       

        $supplier->supplier_code = $request->supplier_code;
        $supplier->supplier_name = $request->supplier_name;
        $supplier->contact_person = $request->contact_person;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->store_name = $request->store;
        $supplier->vat_reg_num = $request->vat;
        $supplier->address = $request->address;
        $supplier->upazila_id = $request->upazila;
        $supplier->description = $request->description;
        $supplier->save();

        Session::flash('success','Supplier Added Successfully!!!');

        return redirect()->route('supplier.index');
        
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
        
        $supplier = Supplier::findOrFail($id);

        if($request->hasFile('img')){
            $image_path = 'storage/images/suppliers/' . $request->old_img;
               if (File::exists($image_path)) {
                   File::delete($image_path);
                }
            $image = $request->file('img');
            $imageName = 'supplier_'.mt_rand(100,999).time().'.'.$image->getClientOriginalExtension();
            $uploadPath = 'storage/images/suppliers';
            $image->move($uploadPath, $imageName);
            $supplier->img = $imageName;
        }

        $supplier->supplier_code = $request->supplier_code;
        $supplier->supplier_name = $request->supplier_name;
        $supplier->contact_person = $request->contact_person;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->store_name = $request->store;
        $supplier->vat_reg_num = $request->vat;
        $supplier->address = $request->address;
        $supplier->upazila_id = $request->upazila;
        $supplier->description = $request->description;
       

        $supplier->save();

        Session::flash('success','Supplier Updated Successfully!!!');

        return redirect()->route('supplier.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Supplier::findOrFail($id)->delete();

        Session::flash('error', "Supplier Removed !!!");
        return redirect()->route('supplier.index');
    }
}
