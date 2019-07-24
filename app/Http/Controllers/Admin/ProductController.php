<?php

namespace App\Http\Controllers\Admin;

use App\Models\Unit;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        $units = Unit::all();
        $brands = Brand::all();
        $attributes = Attribute::all();
        $suppliers = Supplier::all();

        return view('admin.product.index', compact('products','categories','units','brands','attributes','suppliers'));
    }

       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $units = Unit::all();
        $brands = Brand::all();
        $attributes = Attribute::all();
        $suppliers = Supplier::all();

        return view('admin.product.create', compact('categories','units','brands','attributes','suppliers'));
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
            'product_code' => 'required|max:255',
            'name' => 'required|max:255',
            'buy_price' => 'required',
            'sell_price' => 'required',
            'is_vatable' => 'required',
            'minimum_stock' => 'required',
            'image' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'unit_id' => 'required',
            'supplier_id' => 'required',
        
        ]);

        $product = new Product();
        
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = 'product_'.str_random(6).'.'.$image->getClientOriginalExtension();
            $uploadPath = 'storage/images/product/image';
            $image->move($uploadPath, $imageName);
            $product->img = $imageName;
        }
        
        $product->product_code = request('product_code');
        $product->name = request('name');
        $product->buy_price = request('buy_price');
        $product->sell_price = request('sell_price');
        $product->is_vatable = request('is_vatable');
        $product->minimum_stock = request('minimum_stock');
        $product->description = request('description');
        $product->category_id = request('category_id');
        $product->brand_id = request('brand_id');
        $product->unit_id = request('unit_id');
        $product->supplier_id = request('supplier_id');
        $product->save();
        
        foreach ($request->att_name as $key => $value) {
            //ProductStock::create($value);
            $attribute = new Attribute();      
            $attribute->name = $request->att_name[$key];
            $attribute->value = $request->att_value[$key];
            $attribute->product_id = $product->id;  
            $attribute->save();
        }
        
        Session::flash('success','Product Added Successfully!');
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
       
        return view('admin.product.show', compact('product'));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $units = Unit::all();
        $brands = Brand::all();
        $attributes = Attribute::all();
        $suppliers = Supplier::all();
        $product = Product::find($id);

        return view('admin.product.edit', compact('product','categories','units','brands','attributes','suppliers'));  
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
            'product_code' => 'required|max:255',
            'name' => 'required|max:255',
            'buy_price' => 'required',
            'sell_price' => 'required',
            'is_vatable' => 'required',
            'minimum_stock' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'unit_id' => 'required',
        ]);

        $product = Product::find($id);

        if($request->hasFile('image')){
            $image_path = 'storage/images/product/image' . $product->img;
            if (File::exists($image_path)) {
                File::delete($image_path);
            }

            $image = $request->file('image');
            $imageName = 'product_'.str_random(6).'.'.$image->getClientOriginalExtension();
            $uploadPath = 'storage/images/product/image';
            $image->move($uploadPath, $imageName);
            $product->img = $imageName;
        }
        
        $product->product_code = request('product_code');
        $product->name = request('name');
        $product->buy_price = request('buy_price');
        $product->sell_price = request('sell_price');
        $product->is_vatable = request('is_vatable');
        $product->minimum_stock = request('minimum_stock');
        $product->description = request('description');
        $product->category_id = request('category_id');
        $product->brand_id = request('brand_id');
        $product->unit_id = request('unit_id');
        $product->save();

        $attribute = Attribute::where('product_id',$id)->delete();
        foreach ($request->att_name as $key => $value) {
            $attribute = new Attribute();      
            $attribute->name = $request->att_name[$key];
            $attribute->value = $request->att_value[$key];
            $attribute->product_id = $product->id;  
            $attribute->save();
        }

        Session::flash('success','Product Updated Successfully!');
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $image_path = 'storage/images/' . $product->img;
               if (File::exists($image_path)) {
                   File::delete($image_path);
                }
        $product->delete();

        return redirect('products')->with('success', 'product successfully deleted!');
    }
}
