<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\Store;
use App\Models\Brand;
use App\Models\Category;
use Carbon\Carbon;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promotions = Promotion::all();
        $stores = Store::all();
        return view('admin.promotion.index', compact('stores', 'promotions'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $stores = Store::all();
        $brands = Brand::all();
        $categories = Category::where('parent_id',0)->get();
        return view('admin.promotion.add-promotion', compact('stores','brands','categories'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $promotion = new Promotion();
        $promotion->title = $request->title;
        $promotion->type = $request->promotion_type;
        $promotion->status = $request->status;
        $promotion->start_from = Carbon::parse($request->from_date);
        $promotion->end_to = Carbon::parse($request->to_date);
        $promotion->discount_type = $request->discount;
        $promotion->minimum_buy = $request->minimum;
        $promotion->discount_amount = $request->amount;
        $promotion->description = $request->description;
        
        $promotion->save();

        foreach($request->store as $store){
            $promotion->stores()->attach($store);
        }
        if(isset($request->subCats)){
            foreach($request->subCats as $cat){
                $promotion->categories()->attach($cat);
            }
        }
        
        if(isset($request->brand)){
            foreach($request->brand as $bra){
                $promotion->brands()->attach($bra);
            }
        }
        

        Session::flash('success','New Promotion Added Successfully');

        return redirect()->route('promotion.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $promotion = Promotion::findOrFail($id);
        $stores = Store::all();
        $brands = Brand::all();
        $categories = Category::where('parent_id',0)->get();
        return view('admin.promotion.edit-promotion', compact('promotion','stores','brands','categories'));
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
        $promotion = Promotion::findOrFail($id);

        $promotion->title = $request->title;
        $promotion->type = $request->promotion_type;
        $promotion->status = $request->status;
        $promotion->start_from = Carbon::parse($request->from_date);
        $promotion->end_to = Carbon::parse($request->to_date);
        $promotion->discount_type = $request->discount;
        $promotion->minimum_buy = $request->minimum;
        $promotion->discount_amount = $request->amount;
        $promotion->description = $request->description;
        
        $promotion->save();

        DB::table('promotion_store')->where('promotion_id',$promotion->id)->delete();
        DB::table('brand_promotion')->where('promotion_id',$promotion->id)->delete();
        DB::table('category_promotion')->where('promotion_id',$promotion->id)->delete();

        foreach($request->store as $store){
            $promotion->stores()->attach($store);
        }
        foreach($request->subCats as $cat){
            $promotion->categories()->attach($cat);
        }
        foreach($request->brand as $bra){
            $promotion->brands()->attach($bra);
        }

        Session::flash('success','Promotion Updated!');

        return redirect()->route('promotion.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Promotion::findOrFail($id)->delete();

        Session::flash('error','Promotion Deleted!');

        return redirect()->route('promotion.index');
    }

    public function subcategory($id){
        $category = Category::where('parent_id',$id)->get();
        return response()->json(['success' => true, 'category'=>$category]);
    }
}
