<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();

        return view('admin.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'image' => 'required',
            'description' => '',
        ]);
        
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = 'brand_'.str_random(6).'.'.$image->getClientOriginalExtension();
            $uploadPath = 'storage/images/brands';
            $image->move($uploadPath, $imageName);
        }
        
        $brand = new Brand();
        $brand->name = request('name');
        $brand->logo = $imageName;
        $brand->description = request('description');
        $brand->save();

        Session::flash('success','Brand info successfully saved.');
        return redirect()->route('brands.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brand = Brand::find($id);
       
        return view('admin.brand.show', compact('brand'));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.brand.index', compact('brand'));  
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
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required',
        ]);

        $brand = Brand::find($id);

        if($request->hasFile('image')){
            
            $image_path = 'storage/images/brands' . $brand->logo;
            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            $image = $request->file('image');
            $imageName = 'brand_'.str_random(6).'.'.$image->getClientOriginalExtension();
            $uploadPath = 'storage/images/brands';
            $image->move($uploadPath, $imageName);
            $brand->logo = $imageName;
        }
        
        $brand->name = $request->name;
        $brand->description = $request->description;
        $brand->save();

        Session::flash('success','Brand info successfully updated!');
        return redirect()->route('brands.index');
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $brand = Brand::find($id);
        $image_path = 'storage/images/brands' . $brand->logo;
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $brand->delete();

        Session::flash('error','Brand deleted successfully');
        return redirect()->route('brands.index');
    }
}
